<?php

class Input
{
    public string $int;

    public function parcing(string $parceString)
    {
        $regexp = "/\s+/";
        $visual = preg_replace($regexp, '', $parceString);

        $regexp = "/\·|\×/";
        $visual = preg_replace($regexp, '*', $visual);

        $regexp = "/:/";
        $visual = preg_replace($regexp, '/', $visual);

        $regexp = "/=/";
        $visual = preg_replace($regexp, '', $visual);

        $regexp = "/\)\(/";
        $visual = preg_replace($regexp, ')*(', $visual);

        $regexp = "/\d+\*0/";
        $visual = preg_replace($regexp, '0', $visual);

        while(preg_match('/\(\-?\d+\)/', $visual))
        {
            preg_match('/\(\-?\d+\)/', $visual, $exp);
            $pattern = $exp[0];

            $regexp = "/\(|\)/";
            $exp[0] = preg_replace($regexp, "", $exp[0]);
            $visual = str_replace($pattern, $exp[0], $visual);
        }

        $regexp = "/\-\-/";
        $visual = preg_replace($regexp, '+', $visual);

        $regexp = "/\+\-|\-\+/";
        $visual = preg_replace($regexp, '-', $visual);

        $regexp = "/[^\d^\+^\-^\*^\/^\(^\)^\.]/";
        if(preg_match($regexp, $visual))
        {
            preg_match($regexp, $visual, $error);
            return "Ошибка! присутствует неизвестный символ: ".$error[0];
        }

        $regexp = "/\(\)/";
        $visual = preg_replace($regexp, '', $visual);

        $regexp = "/^[^\-^\d^\(]/";
        $visual = preg_replace($regexp, '', $visual);

        $regexp = "/[^\)^\d]*$/";
        $visual = preg_replace($regexp, '', $visual);

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
                $visual = $this->parsingWithoutStaples($visual);
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
            while(preg_match("/\-?\d+[\+\-\*\/]\d+/", $exp[0]))
            {
                if (preg_match("/\d+[\*\/]\d+/", $exp[0]))
                {
                    preg_match("/\d+[\*\/]\d+/", $exp[0], $match);
                } else {
                    preg_match("/\-?\d+[\+\-]\d+/", $exp[0], $match);
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
                $exp[0] = str_replace($match[0], $answer, $exp[0]);
                if (preg_match("/^\-?\d+$/", $exp[0]))
                {
                    $visual=str_replace($pattern, $exp[0], $visual);
                    break;
                }
            }
        }
        while(preg_match("/\-\-/", $visual))
        {
            $visual = preg_replace('/--/', '+', $visual);
        }
        return $visual;
    }

    public function parsingWithoutStaples(string $visual)
    {
        while (preg_match("/\-?\d+[\+\-\*\/]/", $visual))
        {
            if (preg_match("/\-?\d+[\*\/]\d+/", $visual))
            {
                preg_match("/\-?\d+[\*\/]\d+/", $visual, $match);
            } else {
                preg_match("/^\-?\d+[\+\-]\d+/", $visual, $match);
            }
            preg_match_all("/^\-?\d+|\d+/", $match[0], $numbers);
            preg_match_all("/[\+\-\*\/]/", $match[0], $operators);
            if (isset($operators[0][1])) {
                $operator = $operators[0][1];
            } else {
                $operator = $operators[0][0];
            }
            switch ($operator) {
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
            $visual = str_replace($match[0], $answer, $visual);
            if (preg_match("/^\d+$/", $visual)) {
                break;
            }
        }
        return $visual;
    }

    public function setInt()
    {
        if (!empty($_POST['calc']))
        {
            $num = $_POST['calc'];
            if (!empty($this->int))
            {
                $this->int .= $num;
                return $this->int;
            } else {
                $this->int = $num;
                return $this->int;
            }
        }
        elseif (isset($_POST['reset']))
        {
            return $this->reset();
        } else {
            $this->int = 0;
            return $this->int;
        }
    }

    public function reset()
    {
        $this->int = 0;
        return $this->int;
    }
}