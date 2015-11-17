	var vector = feed(10000);

	// ------------------------------ //

	Array.prototype.min = function(array) {
		return Math.min.apply(null, array);
	}

	Array.prototype.max = function(array) {
		return Math.max.apply(null, array);
	}

	function printv(vector) 
	{
		var vs = "";

		for(var a = 0; a < vector.length; a++) {
			vs += vector[a];
			vs += " ";
			if(a < vector.length-1) vs += ",";
		}

		return vs;
	}

	function feed(quant) 
	{
		var array = new Array(quant);		

		for(var a = 0; a < quant;)
		{
			var valor = (Math.floor((Math.random() * (quant))) + 10);
			array[a++] = valor;			
		}		

		return array;
	}

	function run() 
	{
		
		//testShell(vector, 2);
		//testQuick(vector, 0, vector.length - 1);
		//testMerge(vector, 0, vector.length - 1); -- > Erro de recursão 
		//testBin(vector);
		//testRadix(vector);
		<?php $db->close(); ?>
	}

	function testShell(array, gap) 
	{
		var start = new Date();
		shell(array, gap);
		var end = new Date() - start;
		console.log(end+"ms.");
	}

	function shell(array, gap) 
	{
		var current = (array.length / gap);

		while(current > 0)
		{
			for(var a = 0; (current + a) < array.length; a++)
			{
				if(array[a] > array[current + a]) {
					var aux = array[a];
					array[a] = array[current + a];
					array[current + a] = aux;
				}
			}

			current /= gap;			
		}

		current = 0;
		
		for(var a = 0; a < array.length; a++, current++)
		{
			for(var b = current; b > 0; b--)
			{
				if(array[b-1] > array[b]) {
					var aux = array[b];
					array[b] = array[b-1];
					array[b-1] = aux;
				}
			}
		}		
	}

	function testQuick(vector, esquerda, direita)
	{
		var start = new Date(); 
		quick(vector, esquerda, direita);
		var end = new Date() - start;
		console.log(end+"ms."); 
	}

	function quick(vector, esquerda, direita)
	{ 
		var esq = esquerda;  
	    var dir = direita;  
	    var pivot = vector[ Math.floor((esq + dir) / 2)];  
	   
	    var troca = 0;	    

	    while (esq <= dir) 
	    {  
	    	while (vector[esq] < pivot) { esq++; }
	        while (vector[dir] > pivot) { dir--; }
	        if (esq <= dir) 
	        {  
	            troca = vector[esq];  
	            vector[esq] = vector[dir];  
	            vector[dir] = troca;  
	            esq++;  
	            dir--;  	            	            
	        }  	               
	    }
	    
	    if (dir > esquerda) quick(vector, esquerda, dir);  
	    if (esq < direita)  quick(vector, esq, direita); 

	    return vector;	    
	}

	function testMerge(array, inicio, fim) 
	{
		var start = new Date(); 
		merge(array, inicio, fim);
		var end = new Date() - start;
		console.log(end+"ms."); 
	}

	function merge(array, inicio, fim) 
	{
		if (fim < inicio) return;

		numTroca=0;
		meio = Math.round((inicio + fim) / 2);	
		
		merge(array, inicio, meio);
		merge(array, meio + 1, fim);
		
		A = new Array(meio - inicio + 1); for(a = 0; a < meio - inicio + 1; a++) { A[a] = a; }
		B = new Array(fim - meio); for(a = 0; a < fim - meio; a++) { B[a]  = a;}
			
		for (i = 0; i <= meio - inicio; i++) A[i] = array[inicio + i];
		for (i = 0; i <= fim - meio - 1; i++) B[i] = array[meio + 1 + i];
		
		i = 0;
		j = 0;

		for (k = inicio; k <= fim; k++) 
		{
			if (i < A.length && j < B.length) 
			{
				if (A[i] < B[j]) array[k] = A[i++];
				else array[k] = B[j++];
				numTroca++;
			}
			else if (i < A.length) array[k] = A[i++];
			else if (j < B.length) array[k] = B[j++];	
		}

		return numTroca;		
	}

	function testBin(vector)
	{
		var start = new Date(); 
		bin(vector);
		var end = new Date() - start;
		console.log(end+"ms.");
	}

	function bin(vector)
	{	
		var bucket = new Array(Math.max.apply(null, vector)+1);
		var vs = "";

		for(var a = 0; a < bucket.length; a++) bucket[a] = 0;
		for(var a = 0; a < vector.length; a++)  bucket[vector[a]]++;	
		return bucket;
	}

	function testRadix(vector)
	{
		printv(vector);
		var start = new Date(); 
		radix(vector);
		var end = new Date() - start;
		console.log(end+"ms.");
		printv(vector);
	}

	function radix(vector) 
	{
	    var i = 0;
	    var b = new Array(vector.length);
	    var maior = vector[0];
	    var exp = 1;
	  
	    for(a = 0; a < vector.length; a++) b[a] = 0;
	  
	    for (i = 0; i < vector.length; i++) {
	        if (vector[i] > maior)
	            maior = vector[i];
	    }
	 
	    while ( Math.floor(maior/exp) > 0) 
	    {
	        var bucket = new Array(vector.length); for(a = 0; a < vector.length; a++) bucket[a] = 0;       
	        for (i = 0; i < vector.length; i++)
	            bucket[Math.floor(vector[i] / exp) % 10]++; 
	        for (i = 1; i < 10; i++)
	            bucket[i] += bucket[i - 1];
	        for (i = vector.length - 1; i >= 0; i--)
	            b[--bucket[Math.floor(vector[i] / exp) % 10]] = vector[i];
	        for (i = 0; i < vector.length; i++)
	            vector[i] = b[i];
	        exp *= 10;
	    }
 	}