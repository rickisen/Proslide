var pattern = /Java/g;
var text = "Javascript asd asdas das das das d, Java!";
var result;

while ( (result = pattern.exec(text)) != null){
	console.log(result[0]);
}

// ABC = hitta ABC
// [ABC] =  a, b eller c
// \d = hitta alla siffror
// \d{2,} = alla siffror som är minst 2 i följd
// \w{5,} = alla ord som är minst 5 bokstäver långa 
// \W = Allt som inte är ett ord 
