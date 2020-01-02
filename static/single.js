/* ----

# Single Theme
# By: Dreamer-Paul
# Last Update: 2019.11.17

一个简洁大气，含夜间模式的 Typecho 博客模板。

欢迎你加入缤奇，和我们一起改变世界。
本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

var Paul_Single = function (config) {
    var body = document.body;
    var content = ks.select(".post-content:not(.is-special), .page-content:not(.is-special)");

    // 菜单按钮
    this.header = function () {
        var toggle = ks.select(".toggle-btn");
        var menu = ks.select(".head-menu");

        ks.select(".toggle-btn").onclick = function () {
            menu.classList.toggle("active");
        };

        ks.select(".light-btn").onclick = this.night;

        var search = ks.select(".search-btn");
        var bar = ks.select(".head-search");

        search.addEventListener("click", function () {
            bar.classList.toggle("active");
        })
    };

    // 关灯切换
    this.night = function () {
        if(body.classList.contains("neon")){
            body.classList.remove("neon");
            document.cookie = "night=false;" + "path=/;" + "max-age=21600";
        }
        else{
            body.classList.add("neon");
            document.cookie = "night=true;" + "path=/;" + "max-age=21600";
        }
    };

    //分类栏
    this.category = function () {
        var wrap = ks.select(".wrap");
        var categoryList = config.categorys.stack;
        if (categoryList.length > 0) {
            body.classList.add("has-trees");
            var trees = ks.create("aside");
            trees.className = "article-list";
            trees.innerHTML += "<h3>分类目录：</h3>";

            for (var i = 0; i < categoryList.length; i++) {
                var category = categoryList[i];

                var item = ks.create("a", { title: category.name, text: category.name, href: category.permalink});
                item.setAttribute("slug", category.slug);

                if (category.directory.length > 1) {
                    item.classList.add("subCategory")
                    item.innerText = "- " + item.innerText
                }

                var itemSpan = ks.create("span");
                itemSpan.classList.add("badge");
                itemSpan.classList.add("categoryCount");
                itemSpan.innerText = category.count + " 篇";

                item.appendChild(itemSpan);

                trees.appendChild(item);
            }

            wrap.appendChild(trees);

            function toggle_tree() {
                var buttons = ks.select("footer .buttons");
                var btn = ks.create("a", {class: "toggle-list"});
                buttons.appendChild(btn);

                btn.addEventListener("click", function () {
                    trees.classList.toggle("active");
                })
            }
            toggle_tree();
        }

    }

    // 目录树
    this.tree = function () {
        var id = 1;
        var wrap = ks.select(".wrap");
        var headings = content.querySelectorAll("h1, h2, h3, h4, h5, h6");

        if(headings.length > 0){
            body.classList.add("has-trees");

            var trees = ks.create("section", {
                class: "article-list",
                html: "<h4><span class=\"title\">目录</span></h4>"
            });

            ks.each(headings, function (t) {
                var cls, text = t.innerText;

                t.id = "title-" + id;

                switch (t.tagName){
                    case "H2": cls = "item-2"; break;
                    case "H3": cls = "item-3"; break;
                    case "H4": cls = "item-4"; break;
                    case "H5": cls = "item-5"; break;
                    case "H6": cls = "item-6"; break;
                }

                trees.appendChild(ks.create("a", {class: cls, text: text, href: "#title-" + id}));

                id++;
            });

            wrap.appendChild(trees);

            function toggle_tree() {
                var buttons = ks.select("footer .buttons");
                var btn = ks.create("a", {class: "toggle-list"});
                buttons.appendChild(btn);

                btn.addEventListener("click", function () {
                    trees.classList.toggle("active");
                })
            }
            toggle_tree();

            ks.scrollTo(".article-list a", 100);
        }
    };

    // 自动添加外链
    this.links = function () {
        var l = content.getElementsByTagName("a");

        if(l){
            ks.each(l, function (t) {
                t.target = "_blank";
            });
        }
    };

    this.comment_list = function () {
        ks(".comment-content a").each(function (t) {
            var item = ks.select(t.getAttribute("href"));

            t.onmouseover = function () {
                item.classList.add("active");
            };

            t.onmouseout = function () {
                item.classList.remove("active");
            };
        });
    };

    // 返回页首
    this.to_top = function () {
        var btn = document.getElementsByClassName("to-top")[0];
        var scroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

        scroll >= window.innerHeight / 2 ? btn.classList.add("active") : btn.classList.remove("active");
    };

    this.header();

    if(content){
        this.tree();
        this.links();
        this.comment_list();
    }

    if (page) {
        this.category();
    }

    // 返回页首
    window.addEventListener("scroll", this.to_top);

    // 如果开启自动夜间模式
    if(config.night){
        var hour = new Date().getHours();

        if(document.cookie.indexOf("night") === -1 && (hour <= 5 || hour >= 22)){
            document.body.classList.add("neon");
            document.cookie = "night=true;" + "path=/;" + "max-age=21600";
        }
    }

    // 如果开启复制内容提示
    if(config.copyright){
        document.oncopy = function () {
            ks.notice("复制内容请注明来源并保留版权信息！", {
                color: "yellow",
                overlay: true
            })
        };
    }
};

// 图片缩放
ks.image(".post-content:not(.is-special) img, .page-content:not(.is-special) img");

// 平滑滚动
ks.scrollTo(".to-top");

// 请保留版权说明
if (window.console && window.console.log) {
    console.log("%c Single %c https://paugram.com ", "color: #fff; margin: 1em 0; padding: 5px 0; background: #ffa628;", "margin: 1em 0; padding: 5px 0; background: #efefef;");
}