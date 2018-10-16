<?php
/**
 * Created by PhpStorm.
 * User: rdoliveira
 * Date: 04/10/2018
 * Time: 17:34
 */

include_once 'TemperaSimulada.php';

?>

<style>
    *, *::before, *::after{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -o-box-sizing: border-box;
    }

    #tabuleiro {
        width:100%;
        height:100%;
    }

    #containerFull {
        margin-left:auto;
        margin-right:auto;
        width:600px;
        height:600px;
    }

    #container {
        border: 3px solid #000;
        width: 600px;
        height: 600px;
        border-radius: 5px;
        float: left;
    }

    .row {
        clear: both;
    }

    .row div {
        font-size: 3em;
        float: left;
        width: var(--n);
        height: var(--n);
        border-left: 1.5px solid #000;
        border-bottom: 1.5px solid #000;
        text-align: center;
    }

    .row div:first-child {
        border-left: 0;
    }

    .line-1 div:nth-child(2n+1)  {
        background: #000;
        color: #FFF
    }

    .line-2 div:nth-child(2n)  {
        background: #000;
        color: #FFF
    }
</style>

<div id="tabuleiro">

</div>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {
        getParametros();
    });

    function getParametros() {
        var n = prompt("Informe o tamanho do tabuleiro", 8);
        var iter = prompt("Informe o número de iterações", 1000);
        var temp = prompt("Informe a temperatura inicial", 120);
        var txRes = prompt("Informe a taxa de resfriamento (0.01 até 0.99)", 0.95);

        if (n !== '' && iter !== '' && temp !== '' && txRes !== '') {
            var i = 0;
            var tempera;
            $.ajax({
                type: 'POST',
                url: 'route.php?action=inicializar',
                data: {
                    n: n,
                    temperatura: temp,
                    txResfriamento: txRes
                },
                dataType: 'json',
                async: false,
                complete: function (response) {
                    tempera = response.responseJSON;
                    console.log(tempera);

                }
            });
            while (i < iter) {
                $.ajax({
                    type: 'GET',
                    url: 'route.php?action=busca',
                    data: {
                        tabuleiro: tempera['tabuleiro'],
                        custo: tempera['custo'],
                        temperatura: tempera['temperatura'],
                        txResfriamento: tempera['txResfriamento']
                    },
                    dataType: 'json',
                    async: false,
                    complete: function (response) {
                        console.log(response);
                        tempera = response.responseJSON;
                        doSetTimeout(tempera, i);
                    }
                });
                if (tempera.custo === 0) {
                    i = iter;
                    alert('Solução encontrada');
                } else {
                    i++;
                    console.log(i);
                    console.log(iter);
                    if (i === parseInt(iter)){
                        alert('Solução não encontrada');
                    }
                }
            }
        }
    }

    function doSetTimeout(tempera, i) {
        setTimeout(function() {
            $.ajax({
                type: 'GET',
                url: 'route.php?action=mostrartabuleiro',
                data: {
                    tabuleiro: tempera['tabuleiro'],
                    custo: tempera['custo'],
                    temperatura: tempera['temperatura'],
                    txResfriamento: tempera['txResfriamento']
                },
                dataType: 'json',
                async: false,
                complete: function (response) {
                    $('#tabuleiro').empty().append(response.responseText);
                }
            });
        }, i*100);
    }
</script>