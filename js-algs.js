	var vector = null;

	// ------------------------------ //

	Array.prototype.min = function(array) {
		return Math.min.apply(null, array);
	}

	Array.prototype.max = function(array) {
		return Math.max.apply(null, array);
	}

	function getMax(array) {
		var maior = array[0];
		for(var a = 0; a < array.length; a++) {
			if(array[a] > maior) 
				maior = array;
		}

		return maior;
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
			var valor = (Math.floor((Math.random() * (quant))) + 1);
			array[a++] = valor;			
		}		

		return array;
	}

	function testAll(index, test) 
	{
		if(document.getElementById('elementosjs').value < 2) return alert("Insira ao menos 2 elementos para iniciar!");
		if(index == 0) {
			vector = feed(document.getElementById('elementosjs').value);
			console.log("\n");
		}
		
		if(index < 5)
		{
			switch(index)
			{
				case 0: testShell(vector, test); break;
				case 1: testQuick(vector, 0, vector.length - 1, test); break;
				case 2: break;//testMerge(vector, 0, vector.length - 1, test); break;
				case 3: testBin(vector, test); break;
				case 4: testRadix(vector, test); break;
			}

			testAll(index+1, test);
		}
	}

	function testShell(array, test) 
	{
		var start = null;
		var end = null;

		if(test == 0)
		{
			start = new Date();
			shell(array);
			end = new Date() - start; 
		}
		else
		{

		}

		
		console.log(end+"ms.");
		return end;		
	}

	function shell(array) 
	{
		var h = 1;
		var n = array.length
		var numTroca=0;
		
		while(h < n) h = (h * 3) + 1;
		
		h = Math.floor(h / 3);		
		var c = 0; 
		var j = 0;

		while (h > 0) 
		{	
			for (var i = h; i < n; i++) 
			{
	            c = array[i];
	            j = i;
	            while (j >= h && array[j - h] > c) 
	            {
	                array[j] = array[j - h];
	                j = j - h;
	                numTroca++;
	            }
	            array[j] = c;
	        }

	        h = Math.floor(h / 2);	    
	    }    
	}	

	function testQuick(vector, esquerda, direita, test)
	{
		var start = null;
		var end = null;

		if(test == 0)
		{
			start = new Date();
			quick(vector, esquerda, direita);
			end = new Date() - start; 
		}
		else
		{

		}		
		
		console.log(end+"ms."); 
		return end;
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

	function testMerge(array, inicio, fim, test) 
	{
		var start = null;
		var end = null;

		if(test == 0)
		{
			start = new Date();
			merge(array, inicio, fim);
			end = new Date() - start; 
		}
		else
		{

		}
		
		console.log(end+"ms."); 
		return end;
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

	function testBin(vector, test)
	{
		var start = null;
		var end = null;

		if(test == 0)
		{
			start = new Date();
			bin(vector);
			end = new Date() - start; 
		}
		else
		{

		}

		
		console.log(end+"ms.");
		return end;
	}

	function bin(vector)
	{	
		var bucket = new Array(Math.max.apply(null, vector)+1);
		var vs = "";

		for(var a = 0; a < bucket.length; a++) bucket[a] = 0;
		for(var a = 0; a < vector.length; a++)  bucket[vector[a]]++;	
		return bucket;
	}

	function testRadix(vector, test)
	{
		var start = null;
		var end = null;

		if(test == 0)
		{
			start = new Date();
			radix(vector);
			end = new Date() - start; 
		}
		else
		{

		}
		console.log(end+"ms.");
		return end;
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