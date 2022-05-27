function printDiv(className) {
    var divContents = $('.' + className).html();
    var printWindow = window.open();
    printWindow.document.write(divContents);
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}

function printDivById(divId) {
    var divContents = $('#' + divId).html();
    var printWindow = window.open();
    printWindow.document.write(divContents);
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}
