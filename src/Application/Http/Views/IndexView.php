<?php

namespace src\Application\Http\Views;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class IndexView
{
    private $dados;

    public function __construct()
    {
        $this->dados = [
            ['Nome', 'Idade', 'Email'],
            ['João', 25, 'joao@example.com'],
            ['Maria', 30, 'maria@example.com'],
            ['Pedro', 35, 'pedro@example.com']
        ];
    }

    public function render(): ResponseInterface
    {
        $response = new Response();

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </head>
        <body>
        <div class="container mt-4">
            <h1>Tabela de Dados</h1>
            <button class="btn btn-primary" onclick="sincronizarDados()">Sincronizar Dados</button>
            <table class="table mt-4">
                <thead class="thead-light">
                <tr>';

        foreach ($this->dados[0] as $cabecalho) {
            $html .= '<th>' . $cabecalho . '</th>';
        }

        $html .= '
                </tr>
                </thead>
                <tbody>';

        for ($i = 1; $i < count($this->dados); $i++) {
            $html .= '<tr>';

            foreach ($this->dados[$i] as $valor) {
                $html .= '<td>' . $valor . '</td>';
            }

            $html .= '</tr>';
        }

        $html .= '
                </tbody>
            </table>
        </div>
        <script>
            function sincronizarDados() {
                $.ajax({
                    url: "users",
                    method: "GET",
                    success: function (response) {
                        var dados = response;
                        console.log(dados);
                        gerarTabela();
                    },
                    error: function () {
                        alert("Erro ao sincronizar os dados");
                    }
                });
            }

            function gerarTabela() {
                // Código para gerar a tabela com base nos dados atualizados
            }
        </script>
        </body>
        </html>';

        $response->getBody()->write($html);

        return $response;
    }
}