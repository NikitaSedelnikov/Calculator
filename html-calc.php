<?php
include_once 'Input.php';
$num = new Input();
$int = null;
if (!empty($_POST['text']) && isset($_POST['calc']))
{
    $int = $num->parcing($_POST['text']);
} elseif (isset($_POST['reset']))
{
    $int = $num->reset();
}
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        tr, td
        {
            font-size: 30px;
            text-align: center;
            border: 1px solid;
        }
        table td input[type="text"]
        {
            font-size: 25px;
            width: 100%;
            height: 100%;
        }
        table td button[type="submit"]
        {
            width: 100%; height: 100%;
        }
        table td input[type="button"]
        {
            width: 100%; height: 100%;
        }

        .calculator-and-instruction
        {
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            padding-top: 50px;
            display: flex;
            justify-content: space-around;

        }
        .instruction
        {
            height: 100%;
            padding: 10px;
            padding-bottom: 0px;
            border: 2px solid black;
        }

    </style>
</head>
</br>
<div align="center">
    <h1>"Простой" калькулятор</h1>
</div>
<div class="calculator-and-instruction">
<div class="calculator">
<form method="post" action="html-calc.php">
<table>
    <tr>
        <td colspan="4">
            <input class="form-control" type = "text" placeholder="0" name = "text" id="input" value="<?php if (!is_null($int)) {echo $int;}?>"/>
        </td>
    </tr>
        <tr>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '1'" value="1"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '2'" value="2"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '3'" value="3"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '+'" value="+"/>
            </td>
        </tr>
        <tr>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '4'" value="4"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '5'" value="5"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '6'" value="6"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '-'" value="-"/>
            </td>
        </tr>
        <tr>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '7'" value="7"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '8'" value="8"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '9'" value="9"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '*'" value="*"/>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type = "button" onclick="document.getElementById('input').value += '0'" value="0"/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '/'" value="/"/>
            </td>
        </tr>
        <tr>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += '('" value="("/>
            </td>
            <td>
                <input type = "button" onclick="document.getElementById('input').value += ')'" value=")"/>
            </td>
            <td>
                <button type="submit" name="reset" value="">C</button>
            </td>
            <td>
                <button type="submit" name="calc" value="">=</button>
            </td>
        </tr>
</table>
</form>
</div>
    <div class="instruction">
        <p align="center"><b>Памятка</b></p>
        <p>Универсальный калькулятор способен выполнять следующие выражения:</p>
        <p>• <span>Решение выражений с несколькими операндами (более 2-х)</span></p>
        <p>• <span>Решение выражений с использованием операторов: " + " , " - " , " * " , " / "</span></p>
        <p>• <span>Решение выражений с вложенными в скобки "(",")" других выражений</span></p>
        <p>• <span>Замена различных знаков (" = " , " • " , " × " , " : " , " -- " , " +- ") на операнды, знакомые программе</span></p>
        <p>• <span>Удаление пробелов. В случае возникновения сторонних символов - Ошибка</span></p>
    </div>
</div>
</body>