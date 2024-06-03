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

