# c64imagephp

A loose collection of image related PHP scripts for C64

I find myself with various image files that I need to convert to or from C64. It is easy enough
to write a short PHP script to process the bits. They're so useful for me that I thought I'd 
share them on GitHub so other people wouldn't have to write them themselves.

They use the MIT license. Only because, I couldn't find the "Do whatever you like" license. 
But really, do whatever you want with these.

I found a great little tool called HiRes:

Use it at [https://dschwen.github.io/hires/](https://dschwen.github.io/hires/)

This was apparently developed for a pixel art contest for [Stirring Dragon Games](http://www.stirringdragon.games/)' _Unknown Realm_.

It's really great, very simple. Imports from an upload, saves your current work to some sort of 
browser local storage. And you can download at any time, as PNG. The problem is that you then
have the image file as a PNG. What I really want is to take that PNG and convert it to a true
hires image file format, for use in a C64 program.

The conversion is quite simple. It's more or less the inverse of what "renderer.php" does. The
tricky bit is mapping the colors back to the C64 color data. This is what color-palette.php is
for. I used HiRes to create an image that just has the 16 colors up in the top left corner, and
downloaded this as a PNG. Saved it as color-palette.png. color-palette.php reads the color-palette
PNG file in and outputs a mapping between the colors used by HiRes and the C64 color byte values.

If you happen to use a different program other than HiRes, one that uses different color values,
you can do the same trick. Use that other program to create a little color-palette image. Then
generate the mapping using color-palette.php. Copy the mapping into png-hires-convert.php, and
use that to convert a real PNG image from whatever program exports it, to a hires C64 image.

I know that some programs will export as JPEG, but I don't recommend using JPEG as an intermediate
format. Because of the compression, it will not cleanly contain only 16 colors. it will contain 
all sorts of shades as a result of compression artifacts. PNG or GIF should be fine.

If the source is GIF, you should be able to convert that to a PNG without losing anything, using
just about anything. Even the built in Preview for macOS should work. Then make sure to grab the
palette numbers, as such a conversion is bound to modify the exact color values.
