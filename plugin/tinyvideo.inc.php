<?php
/*
PukiWiki - Yet another WikiWikiWeb clone.
tinyvideo.inc.php, v1.01 2020 M. Taniguchi
License: GPL v3 or (at your option) any later version

videoタグを出力するPukiWiki用プラグイン。
videoタグの全ての属性や複数source指定には対応しない簡易的なもの。
PukiWiki 1.5.2／PHP 7.3 で動作確認済み。

【使い方】
#tinyvideo(動画ファイル名{[,幅 高さ][,ポスター画像ファイル名][,controls][,loop][,muted][,autoplay]})
&tinyvideo(動画ファイル名{[,幅 高さ][,ポスター画像ファイル名][,controls][,loop][,muted][,autoplay]});

【引数】
動画ファイル名         … 再生する動画ファイル（拡張子 mp4,mov,ogg,webm 等）
幅 高さ                … 表示サイズ指定（単位：px）、指定なしなら幅100%・高さ自動
ポスター画像ファイル名 … 再生前に表示したい画像ファイル（拡張子 jpg,jpeg,png,gif,webp）※1
controls               … 操作パネル表示 ※2
loop                   … ループ再生
muted                  … 音声ミュート
autoplay               … 自動再生 ※3

※1 ブラウザー／バージョンによっては再生前に何も表示されないことがあるため、ポスター画像の指定を推奨します。
※2 ブラウザー内蔵の標準操作パネル。デザインはブラウザーにより異なります。
※3 実際に自動再生されるかはブラウザーに依存します。特にスマートフォンでは条件が厳しく、常に不可だったり、mutedが必須になるなど。くわしくは「HTML5 videoタグ」等でググって情報収集してください。

【使用例】
&tinyvideo(/videos/sample.mp4,controls);
&tinyvideo(/videos/sample.mp4,/images/sample.jpg,controls,loop,muted,autoplay);
&tinyvideo(/videos/sample.mp4,320 240,controls);

【CSS】
スキンCSSにおいて、次のセレクターで当プラグインが出力するvideoタグを指定することができます。

.plugin-tinyvideo

*/

function plugin_tinyvideo_convert() {
	list($file, $args[0], $args[1], $args[2], $args[3], $args[4], $args[5]) = func_get_args();
	return plugin_tinyvideo_makeVideoTag($file, $args);
}

function plugin_tinyvideo_inline() {
	list($file, $args[0], $args[1], $args[2], $args[3], $args[4], $args[5]) = func_get_args();
	return plugin_tinyvideo_makeVideoTag($file, $args);
}

function plugin_tinyvideo_makeVideoTag($file, $args) {
	static $argNames = array('controls', 'loop', 'muted', 'autoplay');

	$attr = ' playsinline';
	$size = 'width="100%" height="auto"';
	$poster = '';

	foreach ($args as $v) {
		$v = trim($v);
		if (in_array(strtolower($v), $argNames)) {
			$attr .= ' ' . $v;
		} else
		if (preg_match('/^.+\.(jpe?g|png|gif|webp)$/', $v) == 1) {
			$poster = ' poster="' . htmlsc($v) . '"';
		} else
		if (preg_match_all('/\d+/', $v, $match) == 2) {
			$size = 'width="' . (int)$match[0][0] . 'px" height="' . (int)$match[0][1] . 'px"';
		}
	}

	return '<video class="plugin-tinyvideo" ' . $size . $poster . $attr . '><source src="' . htmlsc($file) .'"/></video>';
}
