
window.addEventListener('load', function () {

    const easyMDE = new EasyMDE({
        autofocus: true,
        element: document.getElementById('content'),
        forceSync: true,
        previewImagesInEditor: true,
        maxHeight: '40vh',
        renderingConfig: {
            codeSyntaxHighlighting: true,
        }
    });
})
  