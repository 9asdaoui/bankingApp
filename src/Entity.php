<?php
include_once "TableAttribute.php";


abstract class entity {
    private $reflectionClass;
    private $className;
    private $attributes = [];

    protected function prepareInsertQuery($currentClass = null)
    {
        if($currentClass){                                              
            $this->reflectionClass = new ReflectionClass($currentClass);
            $classAttr = $this->reflectionClass->getAttributes(TableAttribute::class)[0];
            $this->className = $classAttr->newInstance()->columnName;   
        }
        else{
            $this->reflectionClass = new ReflectionClass($this::class);
            $classAttr = $this->reflectionClass->getAttributes(TableAttribute::class)[0];
            $this->className = $classAttr->newInstance()->columnName;
        }
        
        $parentClass = $this->reflectionClass->getParentClass();
        $this->attributes = [];
        foreach ($this->reflectionClass->getProperties() as $property) {
            if ($parentClass && $parentClass->hasProperty($property->getName()) && $property->getName()!='customer_id') {
                continue;
            }

            $attrs = $property->getAttributes(TableAttribute::class);
            foreach ($attrs as $attribute) {
                echo $parentClass->hasProperty($property->getName())."= ".$property->getName()."\n";
                $instance = $attribute->newInstance();
                $this->attributes[] = $instance->columnName;
            }        
        }

        $columns = implode(',', $this->attributes);
        $values = implode(',', array_map(fn($item)=> ':'.$item, $this->attributes));
        $query = "INSERT INTO `$this->className`($columns) VALUES ($values)";
        // echo $query;
        return $query;
    }

    protected function prepareDataValues($currentClass = null)
    {
        if($currentClass){
            $this->reflectionClass = new ReflectionClass($currentClass);
            $classAttr = $this->reflectionClass->getAttributes(TableAttribute::class)[0];
            $this->className = $classAttr->newInstance()->columnName; 
        }
        else{
            $this->reflectionClass = new ReflectionClass($this::class);
            $classAttr = $this->reflectionClass->getAttributes(TableAttribute::class)[0];
            $this->className = $classAttr->newInstance()->columnName;
        }
        
        $parentClass = $this->reflectionClass->getParentClass();
        $this->attributes = [];        
        foreach ($this->reflectionClass->getProperties() as $property) {
            if ($parentClass && $parentClass->hasProperty($property->getName()) && $property->getName()!='customer_id') {
                continue;
            }

            $attrs = $property->getAttributes(TableAttribute::class);
            foreach ($attrs as $attribute) {
                $instance = $attribute->newInstance();
                $this->attributes[] = $instance->columnName;
            }        
        }

        $data = [];
        
        $parentClass = $this->reflectionClass->getParentClass();

        foreach ($this->reflectionClass->getProperties() as $property) {
            
            if ($parentClass && $parentClass->hasProperty($property->getName()) && $property->getName()!='customer_id') {
                continue;
            }

            $property->setAccessible(true);
            $data[":".$property->getName()] = $property->getValue($this);        
        }

        // print_r($data);die();
        return $data;
    }
}

?>
