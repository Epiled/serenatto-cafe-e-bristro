function updateFileName(input) {
    const selectedFile = input.files[0];
    const fileSelectedText = document.getElementById('file-selected');
    fileSelectedText.value = selectedFile.name;
    
    if (selectedFile) {
        fileSelectedText.textContent = selectedFile.name;
    } else {
        fileSelectedText.textContent = '';
    }
}