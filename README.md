# Buenos Networks

## Funcionalidades:

- Tela de Autenticação Login

- Tela de Registrar de Usúarios

- Tela Listar Usúarios

- E-mail de Notificação ao registrar um novo usúario pra disparar e testar a notificação usei o service (Mailtrap) você pode utilizar outros serviços pra testar (se quiser).

- Niveis de permissões para Admin e Commom.

- Validações de todos os formularios.

- Ler Criar Atualizar Deletar *Usúarios*.

- Notificações ao atualizar as informações pessoais e do outro usúario com o notifications push FCM.

## Adicionais ao .env e configurações

```dosini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buenos_network
DB_USERNAME=root
DB_PASSWORD=

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
```

## Próximos Passos (melhorias/alternativas)

- Events -> Utilizar ouvintes para implementar regras adicionais ou a opção abaixo

- Observer -> Observar os eventos em um determinado modelo ou varios modelos 

- Test E2E -> Avalia o sistema como um todo desde da experiência do usúario a testes de integridade.

- Forgot Password -> Implementar recurso de esqueci minha senha.

###  Frameworks

- Laravel ^10.10
- Axios
- Jquuery

### Solid (SRP/ISP)

- Services/AuthenticationService -> Single Responsiblity Principle
- Requests -> Single Responsibility Principle, Interface Segregation Principle

### Recursos

- Javascript Vanilla FCM;
- Notificações por Email;
- Notificações Push;
- Jobs Async;
- Transpilação com Laravel Mix;
- Relacionamento usando Models e Pivots.

## Instale os pacotes e dependências

`composer install`

## Instale os pacotes e dependências

`npm install`

## Compílar os assets

`npm run dev`

## Gerar key da aplicação

`php artisan key:generate`

## Rodar migrações do banco (ORM)

`php artisan migrate --seed`

## Rodar o projeto

`php artisan serve --port=8001`
