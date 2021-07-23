let template2;
CKEDITOR.replace('editor');
CKEDITOR.on('instanceReady', function (evt) {
    var editor = evt.editor;

    editor.on('change', function (e) {
        var contentSpace = editor.ui.space('contents');
        var ckeditorFrameCollection = contentSpace.$.getElementsByTagName('iframe');
        var ckeditorFrame = ckeditorFrameCollection[0];
        var innerDoc = ckeditorFrame.contentDocument;
        var innerDocTextAreaHeight = $(innerDoc.body).height();
        var desc = CKEDITOR.instances['editor'].getData();
        template2 = desc;
        try {
            fetch(
                "Modelo/ModeloReunion/updateTxtNotas.php", {
                method: 'POST', // or 'PUT'
                body: JSON.stringify({
                    template: template2
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    console.log(json.result);
                })
        } catch (error) {
            console.log(error);
        }
    });
});