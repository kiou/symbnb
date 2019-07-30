// setup an "add a tag" link
var $addTagLink = $('<a href="#" class="add_collection btn btn-primary">Ajouter un élément</a>');
var $newLink = $('<li></li>').append($addTagLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $('ul.collection');

    $collectionHolder.find('li.collection-line').each(function() {
        addTagFormDeleteLink($(this));
    });

    $collectionHolder.append($newLink);
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagLink.on('click', function(e) {
        e.preventDefault();
        addTagForm($collectionHolder, $newLink);
    });

});

function addTagForm($collectionHolder, $newLink) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li class="collection-line"></li>').append(newForm);

    $newFormLi.append('<a href="#" class="remove-collection btn btn-danger"><i class="fa fa-trash"></i> Supprimer</a>');
    $newFormLi.find('input').addClass('form-elem big');
    $newLink.before($newFormLi);

    $('.remove-collection').click(function(e) {
        e.preventDefault();
        $(this).parent().remove();
        return false;
    });
}

function addTagFormDeleteLink($newLink) {
    var $removeForm = $('<a href="#" class="remove-collection btn btn-danger"><i class="fa fa-trash"></i> Supprimer</a>');
    $newLink.append($removeForm);

    $removeForm.on('click', function(e) {
        e.preventDefault();
        $newLink.remove();
    });
}