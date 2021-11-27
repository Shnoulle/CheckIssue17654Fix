# CheckIssue17654Fix

Test issue fix

## Before fix

```
    [0] => eventName getPluginTwigPath ,  function getPluginTwigPath, line 52
    [1] => eventName getPluginTwigPath ,  function getPluginTwigPath, line 55
    [2] => eventName beforeQuestionRender ,  function beforeQuestionRender, line 38
    [3] => eventName beforeHasPermission ,  function beforeHasPermission, line 60
    [4] => eventName beforeHasPermission ,  function beforeQuestionRender, line 41
    [5] => eventName getPluginTwigPath ,  function getPluginTwigPath, line 52
    [6] => eventName getPluginTwigPath ,  function getPluginTwigPath, line 55
    [7] => eventName getPluginTwigPath ,  function beforeQuestionRender, line 43
```

Issue at 4 and 7

## After fix

```
    [0] => eventName getPluginTwigPath ,  function getPluginTwigPath, line 52
    [1] => eventName getPluginTwigPath ,  function getPluginTwigPath, line 55
    [2] => eventName beforeQuestionRender ,  function beforeQuestionRender, line 38
    [3] => eventName beforeHasPermission ,  function beforeHasPermission, line 60
    [4] => eventName beforeQuestionRender ,  function beforeQuestionRender, line 41
    [5] => eventName getPluginTwigPath ,  function getPluginTwigPath, line 52
    [6] => eventName getPluginTwigPath ,  function getPluginTwigPath, line 55
    [7] => eventName beforeQuestionRender ,  function beforeQuestionRender, line 43
```

OK at 4 and 7

## Issues ?

- Plugin with own plugin event ?
- Plugin use new event inside previous event ? ( i know none)
