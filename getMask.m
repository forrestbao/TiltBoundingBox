function data = getMask(data,x0,y0,color)

L = size(x0,1);

for l=1:L
    x1 = x0(l,1);
    x2 = x0(l,2);
    y1 = y0(l,1);
    y2 = y0(l,2);

    if (x1 ~= x2)
        y_old = y1;
        
        if x1 <= x2
            u = x1:x2;
        else
            u = x1:-1:x2;
        end
        
        for j=u
            y = (y2-y1)/(x2-x1)*(j-x1) + y1;
            y = round(y);
            
            if y_old <= y
                v = y_old:y;
            else
                v = y_old:-1:y;
            end
            
            for i=v
                data(i,j,:) = color;
            end
            y_old = y;
        end
    else 
        for i=y1:y2
            data(i,x1,:) = color;
        end
        for i=y2:y1
            data(i,x1,:) = color;
        end
        
        
    end
end


