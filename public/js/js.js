function del_row(id,route,token){
   
    if(!confirm('آیا از حذف این رکورد اطمینان دارید؟')){   return false;}

 
    var form=document.createElement('FORM');
    form.setAttribute("method",'POST');
    form.setAttribute("action",route+"/"+id);
    var hiddenField1=document.createElement('INPUT');
    hiddenField1.setAttribute("name",'_method');
    hiddenField1.setAttribute("value","DELETE");
    form.appendChild(hiddenField1);
    var hiddenField2=document.createElement('INPUT');
    hiddenField2.setAttribute("name",'_token');
    hiddenField2.setAttribute("value",token);
    form.appendChild(hiddenField2);
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
