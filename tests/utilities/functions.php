<?php

    function make($class, $times=null, $attributes=[])
    {
        return factory($class, $times)->make($attributes);
    }

    function create($class, $times=null, $attributes=[])
    {
        return factory($class, $times)->create($attributes);
    }