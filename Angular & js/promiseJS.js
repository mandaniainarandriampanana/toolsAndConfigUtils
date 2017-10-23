function asyncFunc() {
    return new Promise((resolve, reject) => { 
		nb = Math.random()*10;
		console.log(nb);
		if(nb>=5){
			setTimeout(() => reject("Error 404"), 4000);
        }else{
        	setTimeout(() => resolve("success 200"), 4000); // (B)
        }
    });
}
asyncFunc()
.then(x => {
	console.log("Result:",x);
}).catch(error => { console.log("Result:",error); });
console.log("efa lasa");