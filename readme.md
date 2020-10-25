## PROJECTMANAGER

`composer update`

#### create JWT RSA

```
$ mkdir -p config/jwt
$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

set `PASSPHRASE=secret` in the `.env` file

#### setup database

setup the database connection in the `.env` file

default example in `.env.example` use mariadb connection
