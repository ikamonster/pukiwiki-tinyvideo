# PukiWiki用プラグイン<br>簡易ビデオ表示 tinyvideo.inc.php

video タグを出力する[PukiWiki](https://pukiwiki.osdn.jp/)用プラグイン。  
video タグの全ての属性や複数 source 指定には対応しない簡易的なもの。

|対象PukiWikiバージョン|対象PHPバージョン|
|:---:|:---:|
|PukiWiki 1.5.3 ~ 1.5.4RC (UTF-8)|PHP 7.4 ~ 8.1|

## インストール

tinyvideo.inc.php を PukiWiki の plugin ディレクトリに配置してください。

## 使い方

```
#tinyvideo(videoUrl{[,width height][,posterImage][,controls][,loop][,muted][,autoplay]})
&tinyvideo(videoUrl{[,width height][,posterImage][,controls][,loop][,muted][,autoplay]});
```

* videoUrl … 再生する動画ファイルのURL（拡張子 mp4, mov, ogg, webm 等）
* width height … 表示サイズ（単位：px）、指定なしなら 幅100% 高さ自動
* posterImage … サムネイル画像ファイル（拡張子 jpg, jpeg, png, gif, webp）
* controls … 操作パネル表示
* loop … ループ再生
* muted … 音声ミュート
* autoplay … 自動再生

## 使用例

```
#tinyvideo(/videos/sample.mp4,controls)
#tinyvideo(/videos/sample.mp4,/images/sample.jpg,controls,loop,muted,autoplay)
#tinyvideo(/videos/sample.mp4,320 180,controls)
```
