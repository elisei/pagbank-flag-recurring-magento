# PagBank Flag Recurring Magento

Essa é uma extensão do módulo pagbank/payment-magento para adiconar uma flag que permite a recorrência de pagamento.

Essa extensão **não faz o motor de recorrência**, ela apenas implementa a ação necessária para a PagBank identificar o pagamento como recorrente.

Sua lógica de definição para o fluxo de pagamento é via configuração administrativa, implementada no arquivo [Model/FlagRecurringConfigProvider.php](../../Model/FlagRecurringConfigProvider.php) em caso de uso em produção recomendamos alterar a lógica para captura dessa informação possivelmente baseada nos produtos do carrinho.

## Resalvas e Advertências de Uso

Essa é uma extensão do módulo oficial da empresa PagBank.

Em caso de dúvidas e problemas com a extensão acionar o time da PagBank/O2TI através do github.

## Instalação

Recomendos a instalação manual, uma vez que em produção você possivelmente precisará alterar a lógica de definição da flag de recorrência.

## Orientação para a constração de um motor de recorrência

Para novos ciclos de pagamento para recorrência você deverá realizar o pagamento utilizando o vault salvo no processo inicial e alterar a flag para 'SUBSEQUENT'.

Exemplo de request, **posterior a todas as etapas anteriores** para o pagamento via recorrência.

```bash
Post para
{{base_url}}/rest/V1/carts/mine/payment-information

{
    "billing_address": {
        "region": "São Paulo",
        "region_id": 508,
        "region_code": "SP",
        "country_id": "BR",
        "street": [
            "Rua Aleatória",
            "22",
            "Bairro"
        ],
        "telephone": "34984427885",
        "postcode": "38017-190",
        "city": "São Paulo",
        "firstname": "Bruno",
        "lastname": "Elisei",
        "email": "brunoelisei@o2ti.com"
    },
    "paymentMethod": {
        "method": "pagbank_paymentmagento_cc_vault",
        "additional_data": {
            "cc_installments": 1,
            "public_hash": "{{vault_public_hash}}",
            "payer_name": "Bruno Elisei",
            "payer_tax_id": "1234567890",
            "payer_phone": "34984427885",
            "recurring_type": "SUBSEQUENT"
        }
    }
}
```
sendo em vault_public_hash

o valor público do cartão salvo, que pode ser obtido com:

```sql
SELECT public_hash FROM seu_db.vault_payment_token where customer_id = 2;
```

e recurring_type agora definido com SUBSEQUENT