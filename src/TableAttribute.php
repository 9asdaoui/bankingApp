<?php

#[Attribute] // Indique que c'est un attribut 
class TableAttribute
{
    public string $columnName;

    public function __construct(string $columnName) {
        $this->columnName = $columnName;
    }
}
