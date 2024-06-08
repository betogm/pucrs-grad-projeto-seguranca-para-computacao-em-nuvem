# pucrs-grad-projeto-seguranca-para-computacao-em-nuvem
PUCRS GRADUAÇÃO TI - Projetos para Disciplina Segurança para Computação em Nuvem

## Instruções Fase 1

### Tarefa 1.2

Executar o arquivo fase-1-aes-ctr-tarefa-1.2.php com o comando abaixo, observando que KEY e IV devem ser em Hexadecimal:

```php
php -f fase-1-aes-ctr-tarefa-1.2.php "Texto a encriptar" KEY IV
```

Exemplo:

```php
php -f fase-1-aes-ctr-tarefa-1.2.php "Texto a encriptar" 33A18467DB4AF474B051523A73DDA955 32414245433734323344363336393343
```

Resulta em:
```
Texto encriptado (hex): e0d0221b7cdcb75b313fc4342453a9df11f31d72d5c49ad1d6df12b31f36683c
Texto decriptado: Texto a encriptar
```

### Tarefa 2.1

Executar o arquivo fase-1-diffie-hellman-tarefa-2.php com o comando abaixo:

```php
php -f fase-1-diffie-hellman-tarefa-2.php p g A b
```

Onde:

p: número primo compartilhado

g: gerador

A: valor público compartilhado da Alice

b: número aleatório de 1 até p - 1 (ou gerado pelo script, se não for passado a ele)


Exemplo utilizando dados do exercício:

p: 1041607122029938459843911326429539139964006065005940226363139

g: 10

A: 105008283869277434967871522668292359874644989537271965222162

b: 47769275707781232167543121472933348266139636086


Comando:

```php
php -f fase-1-diffie-hellman-tarefa-2.php 1041607122029938459843911326429539139964006065005940226363139 10 105008283869277434967871522668292359874644989537271965222162 47769275707781232167543121472933348266139636086
```

Resultado da Execução:
```
Valor p: 1041607122029938459843911326429539139964006065005940226363139
Valor do Gerador g: 10
Valor A (Alice): 105008283869277434967871522668292359874644989537271965222162
Valor b (Bob): 47769275707781232167543121472933348266139636086
Valor B (Bob): B = g^b mod p: 816421167599097235696071584356130817095661258065788442559328
Valor para gerar a chave v: v = A^b mod p: 575172754719713010493973279882508941432073581758961549943197
Hash do valor: f4cfdf76a2eddc3ef0e8239766f5c41525370491f15e03d89a9f02512fc790e5
chave compartilhada 128 bits: f4cfdf76a2eddc3ef0e8239766f5c415
```
