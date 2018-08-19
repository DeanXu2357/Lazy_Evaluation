### 寫在前面

會寫這篇是因為看到 Recca大轉貼燈哥關於 lazy-evaluation 的文章（[ here ](https://oomusou.io/fp/lazy-evaluation/)），因為文章是用 .NET 寫的，基於複習看到的觀念~~（還有 .NET code 真的很難懂，所以寫成 PHP 幫助自己理解）~~ ，所以讓我有了想寫 PHP 版的衝動。



### 話不多說，開始

首先看檔案裡面有兩個 no_ez_evaluation.php 開頭的 php 檔案，這是文中沒有使用 lazy evaluation 的範例，至於未啥會有兩種版本，那是因為一開始我看到範例的時候，以為是像 laravel 裡面的 collection 的用法，結果後來發現用 lazy_evaluation 的版本我根本想不出來怎寫，後來才發現謂何文章的範例要用靜態寫法。

文章開始，有三個靜態方法，分別是 ```map(遍歷每個值，用傳入的匿名函數重新賦值)``` ,  ```filter(用傳入的匿名函數過濾陣列中的值)``` , 和 ```each(遍歷陣列中每個值，執行傳入的匿名函數)```

![無 Lazy Evaluation 版本](/home/poyu/workspace/php/test_yield/pic/1534690050223.png)



然後我們建立新的陣列，裡面有整數 1, 2, 3，依照map所有值乘以三，filter過濾單數，each打印陣列中所有物件，這樣的順序執行

![執行](/home/poyu/workspace/php/test_yield/pic/1534690374402.png)



執行結果：

![執行結果](/home/poyu/workspace/php/test_yield/pic/1534690495739.png)



確實是我們期許的結果，程式碼OK。



再來，我們要換成使用 Lazy Evaluation 的實做。

![Lazy Evaluation 程式碼](/home/poyu/workspace/php/test_yield/pic/1534690673988.png)

中間只有 map 和 filter 函數用 yield 重構。

執行程式碼不變，讓我們看看結果如何。

![Lazy Evaluation 執行結果](/tmp/1534690863374.png)

結果不變，最後都是each我們想看到的3 ,9 ，但是程式的執行順序很神奇的不一樣了，就我理解就是程式到了最後 each 時才真的去跟 iterable 的物件（也就是 $list ）去要東西執行，中間的 map 和 filter 並沒有真的去執行和傳值，所以echo並沒有被執行到。

至於第二好處 --節省記憶體--  ，則是留待各位去實際執行檔和後，範例中會有

```php
echo 'PHP內存用量 : ' . memory_get_usage() . PHP_EOL;
```
告訴你執行當下的記憶體用量，比較前後差異，即可體會有無 yield 差異。



直接說結論，實際執行過後，會發現沒有用 yield 的版本比有用的還少1-10byte的記憶體用量，但是當你把 $nums 陣列從 1-3 ，用 for 迴圈生成 1-10000 就會發現，有用 yield 的版本的記憶體用量壓倒性的低，這是因為 yield 的特性是不管陣列再怎樣大，就只用那點固定的記憶體用量。

