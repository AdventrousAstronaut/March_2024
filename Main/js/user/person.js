const Person = {
    func: {
        uploadAvatar: function (){
            // jQuery 封裝
            // 等價於 document.querySelector("#modalUploadAvatar").modal(...)
            $("#modalUploadAvatar").modal("show")
            alert("friendly alert!")
        }
    }
}