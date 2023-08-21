<?php

namespace src\Application\Http\Views;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class IndexView
{
    public function render(): ResponseInterface
    {
        $response = new Response();

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </head>
        <body>
        <div class="container mt-4">
            <h1>Tabela de Dados</h1>
            <button class="btn btn-primary" onclick="sincronizarDados()">Sincronizar Dados</button>
            <div id="mensagem" class="mt-4"></div>
            <div class="table-responsive">
                <table id="tabela-dados" class="table mt-4">
                    <thead class="thead-light">
                    <tr>
                        <th>Gênero</th>
                        <th>Título</th>
                        <th>Primeiro Nome</th>
                        <th>Último Nome</th>
                        <th>Número da Rua</th>
                        <th>Nome da Rua</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>País</th>
                        <th>Código Postal</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Fuso Horário</th>
                        <th>Descrição do Fuso Horário</th>
                        <th>Email</th>
                        <th>Nome de Usuário</th>
                        <th>Senha</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>Nacionalidade</th>
                        <th>ID do Usuário</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <button id="previousPage" class="btn btn-primary">Anterior</button>
                <span id="currentPage"></span>
                <button id="nextPage" class="btn btn-primary">Próxima</button>
                <span id="totalPages"></span>
            </div>
        </div>
        <script>
            var currentPage = 1;
            var totalPages = 0;
            var dados = [];

            function sincronizarDados() {
                $.ajax({
                    url: "users",
                    method: "GET",
                    success: function (response) {
                        if (Array.isArray(response) && response.length > 0) {
                            dados = response;
                            totalPages = Math.ceil(response.length / 10);
                            gerarTabela(response, currentPage);
                            exibirMensagem("Tabela atualizada com sucesso!", "success");
                        } else {
                            exibirMensagem("Nenhum dado encontrado", "danger");
                        }
                    },
                    error: function () {
                        exibirMensagem("Erro ao sincronizar os dados", "danger");
                    }
                });
            }

            function gerarTabela(dados, page) {
                var tableBody = document.querySelector("#tabela-dados tbody");
                tableBody.innerHTML = "";

                var itemsPerPage = 10;
                var startIndex = (page - 1) * itemsPerPage;
                var endIndex = startIndex + itemsPerPage;

                for (var i = startIndex; i < endIndex && i < dados.length; i++) {
                    var json = JSON.parse(dados[i]);

                    var row = document.createElement("tr");

                    var genderCell = document.createElement("td");
                    genderCell.textContent = json.gender;
                    row.appendChild(genderCell);

                    var titleCell = document.createElement("td");
                    titleCell.textContent = json.name.title;
                    row.appendChild(titleCell);

                    var firstNameCell = document.createElement("td");
                    firstNameCell.textContent = json.name.first;
                    row.appendChild(firstNameCell);

                    var lastNameCell = document.createElement("td");
                    lastNameCell.textContent = json.name.last;
                    row.appendChild(lastNameCell);

                    var streetNumberCell = document.createElement("td");
                    streetNumberCell.textContent = json.street.number;
                    row.appendChild(streetNumberCell);

                    var streetNameCell = document.createElement("td");
                    streetNameCell.textContent = json.street.name;
                    row.appendChild(streetNameCell);

                    var cityCell = document.createElement("td");
                    cityCell.textContent = json.location.city;
                    row.appendChild(cityCell);

                    var stateCell = document.createElement("td");
                    stateCell.textContent = json.location.state;
                    row.appendChild(stateCell);

                    var countryCell = document.createElement("td");
                    countryCell.textContent = json.location.country;
                    row.appendChild(countryCell);

                    var postcodeCell = document.createElement("td");
                    postcodeCell.textContent = json.location.postcode;
                    row.appendChild(postcodeCell);

                    var latitudeCell = document.createElement("td");
                    latitudeCell.textContent = json.coordinates.latitude;
                    row.appendChild(latitudeCell);

                    var longitudeCell = document.createElement("td");
                    longitudeCell.textContent = json.coordinates.longitude;
                    row.appendChild(longitudeCell);

                    var timezoneCell = document.createElement("td");
                    timezoneCell.textContent = json.timezone.description;
                    row.appendChild(timezoneCell);

                    var emailCell = document.createElement("td");
                    emailCell.textContent = json.email;
                    row.appendChild(emailCell);

                    var usernameCell = document.createElement("td");
                    usernameCell.textContent = json.login.username;
                    row.appendChild(usernameCell);

                    var passwordCell = document.createElement("td");
                    passwordCell.textContent = json.login.password;
                    row.appendChild(passwordCell);

                    var phoneCell = document.createElement("td");
                                       phoneCell.textContent = json.phone;
                    row.appendChild(phoneCell);

                    var cellCell = document.createElement("td");
                    cellCell.textContent = json.cell;
                    row.appendChild(cellCell);

                    var natCell = document.createElement("td");
                    natCell.textContent = json.nat;
                    row.appendChild(natCell);

                    var userIdCell = document.createElement("td");
                    userIdCell.textContent = json.userId.value;
                    row.appendChild(userIdCell);

                    tableBody.appendChild(row);
                }

                document.getElementById("currentPage").textContent = "Página " + currentPage;
                document.getElementById("totalPages").textContent = " de " + totalPages;
            }

            function exibirMensagem(mensagem, tipo) {
                var mensagemDiv = document.querySelector("#mensagem");
                mensagemDiv.innerHTML = "";

                var alertDiv = document.createElement("div");
                alertDiv.classList.add("alert", "alert-" + tipo);
                alertDiv.textContent = mensagem;

                mensagemDiv.appendChild(alertDiv);

                alertDiv.classList.add("show");

                setTimeout(function() {
                    alertDiv.classList.remove("show");
                }, 3000);
            }

            document.getElementById("previousPage").addEventListener("click", function() {
                if (currentPage > 1) {
                    currentPage--;
                    gerarTabela(dados, currentPage);
                    document.getElementById("currentPage").textContent = " Página " + currentPage + " ";
                }
            });

            document.getElementById("nextPage").addEventListener("click", function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    gerarTabela(dados, currentPage);
                    document.getElementById("currentPage").textContent = " Página " + currentPage + " ";
                }
            });
        </script>
        </body>
        </html>
        ';

        $response->getBody()->write($html);

        return $response;
    }
}