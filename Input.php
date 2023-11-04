<?php

class Input
{

    public function parcing(string $parceString)
    {
        $visual = preg_replace("/\s+/", '', $parceString);
        $visual = preg_replace("/\·|\×/", '*', $visual);
        $visual = preg_replace("/:/", '/', $visual);
        $visual = preg_replace("/=/", '', $visual);
        $visual = preg_replace("/\)\(/", ')*(', $visual);
        $visual = preg_replace("/\d+\*0/", '0', $visual);

        while(preg_match('/\(\-?\d+\)/', $visual))
        {
            preg_match('/\(\-?\d+\)/', $visual, $exp);
            $pattern = $exp[0];

            $regexp = "/\(|\)/";
            $exp[0] = preg_replace($regexp, "", $exp[0]);
            $visual = str_replace($pattern, $exp[0], $visual);
        }

        $visual = preg_replace("/\-\-/", '+', $visual);
        $visual = preg_replace("/\+\-|\-\+/", '-', $visual);

        $regexp = "/[^\d^\+^\-^\*^\/^\(^\)^\.]/";
        if(preg_match($regexp, $visual))
        {
            preg_match($regexp, $visual, $error);
            return "Ошибка! присутствует неизвестный символ: ".$error[0];
        }

        $visual = preg_replace("/\(\)/", '', $visual);
        $visual = preg_replace("/^[^\-^\d^\(]/", '', $visual);
        $visual = preg_replace("/[^\)^\d]*$/", '', $visual);

        while (true){
            if (preg_match("/\(.*?\)/", $visual))
            {
                $visual = $this->parsingStaples($visual);
            } else {
                break;
            }
        }

        if (preg_match("/\(|\)/", $visual))
        {
            return 'Ошибка выражения';
        }

        while (preg_match("/^\-?\d+[\+\-\*\/].*$/", $visual))
        {
            if (preg_match("/^\-?\d+[\+\-\*\/].*$/", $visual))
            {
                $visual = $this->match($visual);
            } else {
                break;
            }
        }

        return $visual;
    }

    public function summ (string $first, string $second)
    {
        $first = intval($first);
        $second = intval($second);
        $answer = $first + $second;
        return $answer;
    }

    public function subtraction (string $first, string $second)
    {
        $first = intval($first);
        $second = intval($second);
        $answer = $first - $second;
        return $answer;
    }

    public function multiplication (string $first, string $second)
    {
        $first = intval($first);
        $second = intval($second);
        $answer = $first * $second;
        return $answer;
    }

    public function division (string $first, string $second)
    {
        $first = intval($first);
        $second = intval($second);
        $answer = $first / $second;
        return $answer;
    }

    public function parsingStaples(string $visual)
    {
        while(preg_match("/\([^\(\)]+\)/", $visual))
        {
            preg_match("/\([^\(\)]+\)/", $visual, $exp);
            $pattern = $exp[0];
            $exp[0] = preg_replace("/^\(|\)$/", '', $exp[0]);
            if (preg_match("/\([^\(\)]+\)/", $exp[0]))
            {
                $exp[0] = $this->parsingStaples($exp[0]);
            }

            $exp[0] = $this->match($exp[0]);

            if (preg_match("/^\-?\d+$/", $exp[0]))
            {
                $visual=str_replace($pattern, $exp[0], $visual);
                break;
            }
        }
        return $visual;
    }

    public function match($matches)
    {
        while(preg_match("/\-?\d+[\+\-\*\/]\d+/", $matches))
        {
            if (preg_match("/\d+[\*\/]\d+/", $matches))
            {
                preg_match("/\d+[\*\/]\d+/", $matches, $match);
            } else {
                preg_match("/\-?\d+[\+\-]\d+/", $matches, $match);
            }
            preg_match_all("/\-?\d+|\d+/", $match[0], $numbers);
            preg_match_all("/[\+\-\*\/]/", $match[0], $operators);
            if (isset($operators[0][1]))
            {
                $operator = $operators[0][1];
            } else {
                $operator = $operators[0][0];
            }
            switch ($operator)
            {
                case '+':
                    $answer = $this->summ($numbers[0][0], $numbers[0][1]);
                    break;
                case '-':
                    $answer = $this->subtraction($numbers[0][0], $numbers[0][1]);
                    break;
                case '*':
                    $answer = $this->multiplication($numbers[0][0], $numbers[0][1]);
                    break;
                case '/':
                    $answer = $this->division($numbers[0][0], $numbers[0][1]);
                    break;
            }
            $matches = str_replace($match[0], $answer, $matches);
            while(preg_match("/\-\-/", $matches))
            {
                $matches = preg_replace('/--/', '+', $matches);
            }
            if (preg_match("/^\-?\d+$/", $matches)) {
                break;
            }
        }
        return $matches;
    }

    public function reset()
    {
        return 0;
    }
}