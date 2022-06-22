const ipnPass1=document.querySelector('#ipnPassword')
const btnPass=document.querySelector('#btnPassword')
const ipnPass2=document.querySelector('#ipnPasswordAgain')
const btnPassAgain=document.querySelector('#btnPasswordAgain')
const eyeElement=document.querySelector('#btnEye')



btnPass.addEventListener('click',function(){
    
    const currentPassType=ipnPass1.getAttribute('type')
    ipnPass1.setAttribute('type',currentPassType==='password'?'text':'password')
    
})

btnPassAgain.addEventListener('click',function(){
    const currentPassAType=ipnPass2.getAttribute('type')
    ipnPass2.setAttribute('type',currentPassAType==='password'?'text':'password')
})
