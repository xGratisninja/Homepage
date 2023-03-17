function ErrorHandling(Message,type) {
    if(type == "text"){
        let EditMessage = '<p style="color:Red;font-weight: bold;">An Error Occured('+Message+')</p>'
        return(EditMessage)
    } else if (type == "alert") {
        let EditMessage = 'An Error Occured('+Message+')'
        alert(EditMessage)
    }
}
