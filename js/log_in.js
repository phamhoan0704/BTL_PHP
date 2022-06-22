const ipnElement=document.querySelector('#ipnPassword')
const btnElement=document.querySelector('#btnPassword')
const eyeElement=document.querySelector('#btnEye')

let statusEye=false;

btnElement.addEventListener('click',function(){
    
    const currentType=ipnElement.getAttribute('type')
    ipnElement.setAttribute('type',currentType==='password'?'text':'password')
    
})
