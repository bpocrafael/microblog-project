$('form[role="search"]').on('submit', function(e) {
    e.preventDefault();
});

if (window.location.href.includes('/search?')) {
    const urlParams = new URLSearchParams(window.location.search);
    const wordToHighlight = urlParams.get('query');

    highLightText(wordToHighlight);

}

function highLightText(wordToHighlight) {
    const highlightClass = "text-highlight-yellow";

    const regexKeyword = new RegExp(wordToHighlight, 'gi');
    const regexWord = new RegExp('\\b' + wordToHighlight + '\\b', 'gi');

    function highlightTextHandler(text, word, isKeyword = true) {
        const regex = isKeyword ? regexKeyword : regexWord;
        const highlightTemplate = `<span class="${highlightClass}">$&</span>`;
        return text.replace(regex, highlightTemplate);
    }	

    $('.text-to-highlight').each(function() {
        const text = $(this).text();
        const highlightedText = highlightTextHandler(text, wordToHighlight);
        $(this).html(highlightedText);
    });

    $('.word-to-highlight').each(function() {
        const text = $(this).text();
        const highlightedWord = highlightTextHandler(text, wordToHighlight, false);
        $(this).html(highlightedWord);
    });
}
