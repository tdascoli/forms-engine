# ToDo

## Questions

* ~~rename FieldType to Type~~
* ~~rename AbstractField to AbstractElement~~
* ~~move Renderer to Questions~~
* ~~where to integrate FormsEngine Wizard?~~
    * ~~maybe FormsEngine\Wizard and FormsEngine\Presentation or F..E..\Public~~
    * ~~own project: forms-engine-wizard~~
* (/) add if/else functionalities for fields/elements
* ~~add paging (Abschnitt)~~ (/)  (and if/else)
  * ~~static pagination~~
  * ~~(/) refactoring template with elements?!~~
  * ~~"create another" link~~
  * ~~how to deliver pagination JS?~~
* ~~make "CompleteHandler"~~ -> what to do after submit?? -> wrapper!! see arch.md
* ~~(?) refactoring Renderer Class~~

### Element

* ~~readonly~~
* ~~disabled~~
* (?) inputmask (needs work) including refactoring date and dateime(-local)
* ~~hidden (own Element?)~~
* ~~required (construct)~~
* ~~validation (needs work: maybe only html5 validation)~~
* ~~privacy (no)~~
* ~~style (needs work)~~
* ~~options (?)~~
* ~~Button: primary to style!!~~
* (/) Button: how to action? JS? -> script = typeahead
* ~~Button: reset~~
* ~~rename Config to RenderConfig~~
* ~~Element.class = maybe extend from AbstractField -> usable for other things as well (presentation, ...)~~
* ~~JS -> how? see also Validation~~
* ~~attributes like: size, min, max, etc.~~
* ~~textarea~~
* ~~Paragraph!!! needs work~~
* (/) Paragraph: check if tinymce, ckeditor or markdown??
* (/) Paragraph: when markdown, make own element?
* ~~Title - has to be first, always! -> Form Title~~
* ~~autocomplete -> like select except its a autocompleter~~
* ~~autocomplete: check option class?~~
  * ~~https://stackoverflow.com/questions/49324366/bootstrap-4-typeahead~~
  * ~~Option: remove selected?~~
* ~~other?~~
* ~~move templates to own package~~

## Answers

* ~~needs work...~~
* (/) export functionalities (naming?)
    * json
    * ~~xml (no)~~
    * ~~csv - add titles~~
    * ~~plaintext (no)~~
    * ~~xlsx~~
    * ~~email~~
* (/) online "viewer"? (github.com/myliang/x-spreadsheet)
* ~~(/) Persist: only POST or default JS/Binding~~
* ~~(/) Persist: JS/Binding -> watch.js~~
* ~~Persist: no double submits~~
* ~~add "create another" link as Config~~
* ~~config: show message or form (check for refresh??)~~

### Persistence

* ~~refactoring~~
* ~~how to implement own persistence? config!~~

## docs

* ~~(/) create docs page and structure~~
* ~~maybe add to heroku as gh-pages or make it static on gh-pages~~

## other

* ~~Config how to?~~
  * ~~add "all" vars in construct to config (check?) -> (no)~~
* ~~I18n -> multilanguage!!!!~~
* ~~FormsEngine -> Renderer (shortcut to new Renderer)~~
* ~~add sessioning~~
* (/) refactoring according bestpractices:
  * http://bestpractices.thecodingmachine.com/php/design_beautiful_classes_and_methods.html
* (/) Optionals: https://github.com/schmittjoh/php-option/blob/master/src/PhpOption/Some.php
* (/)unit tests
