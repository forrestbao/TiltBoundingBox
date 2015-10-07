function [mask im] = fetch(image, angle, Ax, Ay, w, h)

im = image;
imWidth = size(image,2);
imHeight = size(image,1);

Bx = round(Ax + w*cos(angle));
By = round(Ay - w*sin(angle));

Dx = round(Ax + h*sin(angle));
Dy = round(Ay + h*cos(angle));

Cx = Bx + (Dx - Ax);
Cy = By + (Dy - Ay);

x0 = [Ax Bx; Bx Cx; Cx Dx; Dx Ax];
y0 = [Ay By; By Cy; Cy Dy; Dy Ay];

mask = zeros(imHeight,imWidth);
mask = getMask(mask, x0, y0, 1);
mask = imfill(mask);
mask = uint8(mask);

for i=1:3  
    im(:,:,i) = im(:,:,i).*mask;
end
imshow(im);