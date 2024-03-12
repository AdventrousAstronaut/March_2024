const Index = {
    data: {
        btnHome: document.querySelector("#btnHome"),
        inputSearchWord: document.querySelector("#SearchWord"),
        communityCard: ""
    },
    func: {
        init: function(){
            window.onload = function() {
                console.log("首頁加載完成")
            }
            document.onreadystatechange = function(){
                let loadingMask = document.querySelector("#mask")
                if (document.readyState == "complete") {
                    setTimeout(function(){
                        loadingMask.style.display = "none";
                    }, 100);
                } else {
                    loadingMask.computedStyleMap.display = "block";
                }

                console.log("首頁已準備好")
                Index.func.getCommunity()
            }
        },

        clickHome: function(){
            console.log("首頁導航已經被CLICK@")
        },
        clickSearchWord: function (){
            console.log("已經改變" + Index.data.inputSearchWord.value)
        },

        // 路徑設置很重要
        getCommunity: function(){
            fetch('./../../controllers/office/community.php', {
                method: 'GET',
                mode: 'cors', // 允許發送跨域請求
                credentials: 'include'
            }).then(response => {
                return response.json();
            }).then(data => {
                data.forEach(v => {
                    Index.data.communityCard += `<div class="col">
                    <div class="card card-item" style="width: 18rem;">
                        <img src="/static/assets/images/wallhaven-l8vp7y.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <p class="card-text">welcome back! ${v.username}<br>${v.brief}</p>
                        </div>
                    </div>
                </div>`;
                });
                const community = document.querySelector("#community");
                community.innerHTML = Index.data.communityCard;
                Index.data.communityCard = "";
            });
        }
    }


}