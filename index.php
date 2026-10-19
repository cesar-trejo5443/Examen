<?php
$mostrar_resultados = false;
$puntaje = 0;
$total_preg = 0;
$calificacion = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_form'])) {
    $mostrar_resultados = true;
    
    $respuestas = [
        'pregunta1' => 'a','pregunta2' => 'b','pregunta3' => 'c','pregunta4' => 'd','pregunta5' => 'd',
        'pregunta6' => 'a','pregunta7' => 'b','pregunta8' => 'c','pregunta9' => 'd','pregunta10' => 'd',
        'pregunta11' => 'a','pregunta12' => 'b','pregunta13' => 'c','pregunta14' => 'd','pregunta15' => 'd'
    ];

    $total_preg = count($respuestas);

    foreach ($respuestas as $pregunta => $correcta) {
        if (isset($_POST[$pregunta]) && $_POST[$pregunta] === $correcta) {
            $puntaje++;
        }
    }
    
    $calificacion = ($puntaje / $total_preg) * 10;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
            background-attachment: fixed;
            color: #f8fafc;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            font-size: 18px;
            line-height: 1.6;
            margin: 0;
            padding: 30px 15px 60px;
        }

        .instructions, 
        .answer-card, 
        form {
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .instructions {
            padding: 30px 35px;
            margin-bottom: 35px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-left: 6px solid #6366f1;
            background: rgba(30, 41, 59, 0.75);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .instructions br {
            display: none; 
        }

        .exam {
            margin: 0 0 10px 0;
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(90deg, #ffffff, #a5b4fc);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .instrucciones {
            margin: 0;
            color: #cbd5e1;
            font-size: 18px;
        }

        .question-card {
            padding: 22px 28px 25px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            margin: 0 0 28px 0;
            background-color: #ffffff;
            color: #1e293b;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .question-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.35);
            border-color: #cbd5e1;
        }

        .question-card p {
            margin: 8px 0 18px 0;
            font-weight: 600;
            font-size: 20px;
            color: #0f172a;
        }

        .question-card br {
            display: none; 
        }

        legend {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 6px 18px;
            border-radius: 999px;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
        }

        label {
            display: flex;
            align-items: center;
            padding: 13px 18px;
            margin-bottom: 10px;
            border-radius: 12px;
            border: 2px solid #f1f5f9;
            background-color: #f8fafc;
            color: #334155;
            cursor: pointer;
            font-size: 17px;
            transition: all 0.2s ease;
        }

        label:last-of-type {
            margin-bottom: 0;
        }

        label:hover {
            background-color: #eff6ff;
            border-color: #bfdbfe;
            color: #1e3a8a;
            transform: translateX(4px);
        }

        input[type="radio"] {
            accent-color: #4f46e5;
            width: 20px;
            height: 20px;
            margin: 0 14px 0 0;
            cursor: pointer;
            flex-shrink: 0;
        }

        .answer-selected:active {
            color: inherit;
        }

        .answer-selected label:has(input[type="radio"]:checked) {
            background-color: #eef2ff;
            border-color: #4f46e5;
            color: #312e81;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.12);
        }

        .answer-card {
            background: linear-gradient(to right, #ffffff, #f0fdf4);
            padding: 30px 35px;
            margin-bottom: 35px;
            border-radius: 16px;
            color: #0f172a;
            border: none;
            border-left: 8px solid #10b981;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
            animation: aparecer 0.4s ease-out;
        }

        @keyframes aparecer {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .answer-card h2 {
            margin: 0 0 15px 0;
            color: #065f46;
            font-size: 28px;
        }

        .answer-card p {
            margin: 8px 0;
            font-size: 20px;
            color: #334155;
        }

        .answer-card strong {
            color: #047857;
            font-size: 23px;
        }

        .answer-card a {
            display: inline-block;
            margin-top: 18px;
            padding: 10px 24px;
            background-color: #0f172a;
            color: #ffffff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .answer-card a:hover {
            background-color: #334155;
            transform: translateY(-2px);
        }

        .send_form {
            display: block;
            width: 100%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            margin: 35px 0 10px 0;
            color: #ffffff;
            padding: 18px 28px;
            font-size: 20px;
            font-weight: 700;
             letter-spacing: 0.5px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.45);
            transition: all 0.25s ease;
        }

        .send_form:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(16, 185, 129, 0.65);
        }

        .send_form:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <?php if ($mostrar_resultados): ?>
        <div class="answer-card">
            <h2>Resultado de la evaluación</h2>
            <p>Respuestas correctas: <strong><?= $puntaje ?></strong> de <strong><?= $total_preg ?></strong></p>
            <p>Calificación final: <strong><?= $calificacion ?> / 10</strong></p>
            <a href="">Intentar de nuevo</a>
        </div>
    <?php endif; ?>
    <div class="instructions">
        <h1 class="exam">Examen</h1><br>
        <p class="instrucciones">Lee cuidadosamente y responde las preguntas seleccionando el inciso correcto.</p><br>
    </div>
    <form method="POST">
        <div class="answer-selected"> 
            <fieldset class="question-card">
                <legend>Pregunta 1</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta1" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta1" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta1" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta1" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 2</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta2" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta2" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta2" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta2" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 3</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta3" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta3" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta3" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta3" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 4</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta4" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta4" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta4" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta4" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 5</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta5" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta5" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta5" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta5" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 6</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta6" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta6" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta6" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta6" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 7</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta7" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta7" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta7" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta7" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 8</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta8" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta8" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta8" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta8" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 9</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta9" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta9" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta9" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta9" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 10</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta10" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta10" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta10" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta10" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 11</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta11" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta11" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta11" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta11" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 12</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta12" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta12" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta12" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta12" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 13</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta13" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta13" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta13" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta13" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 14</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta14" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta14" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta14" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta14" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <fieldset class="question-card">
                <legend>Pregunta 15</legend>
                <p>¿¿¿</p>
                <label><input type="radio" name="pregunta15" value="a">a. Respuesta</label><br>
                <label><input type="radio" name="pregunta15" value="b">b. Respuesta</label><br>
                <label><input type="radio" name="pregunta15" value="c">c. Respuesta</label><br>
                <label><input type="radio" name="pregunta15" value="d">d. Respuesta</label><br><br>
            </fieldset>

            <button type="submit" name="send_form" class="send_form">Enviar cuestionario</button>
    </div> 
    </form>
</body>
</html>