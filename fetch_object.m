function [mask im] = fetch_object(image, angle, ux, uy, w, h, zoom)
image_size = 400*(1+zoom/10);
image = imresize(image, [image_size image_size]);
xc = 158;
yc = 183;

im = imrotate(image,360-angle);
imSize = size(im,1);

s = imSize/2;

xs = xc + image_size/2;
ys = yc + image_size/2;

xe = xs - s;
ye = ys - s;

xt = round(ux - xe);
yt = round(uy - ye);

x1 = xt + w;
y1 = yt;

x2 = xt + w;
y2 = yt + h;

x3 = xt;
y3 = yt + h;

x0 = [xt x1; x1 x2; x2 x3; x3 xt];
y0 = [yt y1; y1 y2; y2 y3; y3 yt];

mask = zeros(imSize,imSize);
mask = getMask(mask, x0, y0, 1);
mask = imfill(mask);
mask = uint8(mask);

for i=1:3  
    im(:,:,i) = im(:,:,i).*mask;
end
imshow(im);
end


