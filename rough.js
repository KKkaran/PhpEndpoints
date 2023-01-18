// //this is for practice/test code
// console.log("Line 1")

// setTimeout(_ => console.log("Line 2 from setTimeout"), 0);

// Promise.resolve().then(_=>console.log("Line 3 from promise"))

// console.log("Line 4")
const delay = ms => new Promise(resolve => setTimeout(resolve, ms))

async function call() {
    await delay(1000)
    return Promise.resolve(()=>Date.now() - time)
}
let gg = async() => {
    
    let g1 =  call()
    let g2 =  call()
    
    return Promise.all([g1, g2])
}
let time = Date.now();
//console.log(gg())
gg().then(([y, p]) => {
        console.log(y())
        console.log(p())
    });
console.log("at the end")
