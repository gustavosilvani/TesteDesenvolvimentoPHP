# Meu Projeto

Este é um projeto que utiliza PHP e Slim Framework para criar uma aplicação web que exibe uma tabela de dados de usuários. Os dados são obtidos de uma API externa e são exibidos em uma tabela paginada.
## Instalação

Para executar o projeto, siga as etapas abaixo:

1. Certifique-se de ter o Docker instalado em sua máquina.
2. Clone este repositório para o seu ambiente local.
3. Navegue até o diretório raiz do projeto.
4. Execute o seguinte comando para construir e executar o contêiner Docker:

```bash   
docker-compose up -d   
```

## Uso
Acesse a URL `http://localhost:8000` no seu navegador para visualizar a aplicação em execução.

Após a instalação e execução do projeto, você verá a tabela de dados de usuários sendo exibida. Clique no botão "Sincronizar Dados" para obter os dados da API externa e preencher a tabela.

Você pode navegar pelas páginas da tabela usando os botões "Anterior" e "Próxima". Cada página exibe 10 usuários.


## Licença

Este projeto está licenciado sob a [Licença MIT](https://opensource.org/licenses/MIT).
