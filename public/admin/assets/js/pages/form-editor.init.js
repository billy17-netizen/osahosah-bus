var ckClassicEditor = document.querySelectorAll(".ckeditor-classic");

if (ckClassicEditor) {
    Array.from(ckClassicEditor).forEach(function (el) {
        ClassicEditor.create(el)
            .then(function (e) {
                e.ui.view.editable.element.style.height = "50px";
            })
            .catch(function (e) {
                console.error(e);
            });
    });
}
var snowEditor = document.querySelectorAll(".snow-editor");
var bubbleEditor = document.querySelectorAll(".bubble-editor");

if (snowEditor) {
    Array.from(snowEditor).forEach(function (e) {
        var o = {};
        if (e.classList.contains("snow-editor")) {
            o.theme = "snow";
            o.modules = {
                toolbar: [
                    [{ font: [] }, { size: [] }],
                    ["bold", "italic", "underline", "strike"],
                    [{ color: [] }, { background: [] }],
                    [{ script: "super" }, { script: "sub" }],
                    [
                        { header: [!1, 1, 2, 3, 4, 5, 6] },
                        "blockquote",
                        "code-block",
                    ],
                    [
                        { list: "ordered" },
                        { list: "bullet" },
                        { indent: "-1" },
                        { indent: "+1" },
                    ],
                    ["direction", { align: [] }],
                    ["link", "image", "video"],
                    ["clean"],
                ],
            };
            new Quill(e, o);
        }
    });
}

if (bubbleEditor) {
    Array.from(bubbleEditor).forEach(function (e) {
        var o = {};
        if (e.classList.contains("bubble-editor")) {
            o.theme = "bubble";
            new Quill(e, o);
        }
    });
}
