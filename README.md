# House of Barber
O House of Barber é um sistema online e 100% gratuito que possibilita aos donos de barbearia o gerenciamento e divulgação de suas barbearias. 
Além disso, a plataforma oferta aos clientes os serviços dos diversos estabelecimentos cadastrados.

## Instalação e requisitos

### Requisitos
- [XAMPP](https://www.apachefriends.org/pt_br/index.html)
- [Composer](https://getcomposer.org)
- [Dump do banco de dados](https://drive.google.com/file/d/1Q4nngU731FxutDXAP5RqETpHSFDtSo2T/view?usp=sharing)

### Instalação
Para rodar o projeto, você precisa ter o XAMPP e o dump do banco de dados devidamente configurados na sua máquina.

Após se certificar que este primeiro passo está correto, você deve entrar na pasta da API e instalar as dependências do projeto via composer.
Use o seguinte comando:
`composer install`

Após isso, o projeto estará disponível para ser acessado em ambiente local.

### Observações
- O projeto deve ser clonado na pasta htdocs do XAMPP.
- No momento, a configuração de conexão ao banco de dados está no arquivo Conexao.php. O caminho para o arquivo é `api/App/DAO/MYSQL/HouseOfBarber`.
Caso a sua conexão padrão com o seu BD seja diferente do que está no arquivo, informe as credenciais do seu servidor MySQL.
