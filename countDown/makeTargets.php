// make countDown targets
/*
abcd, abdc, acbd , acdb , adbc , adcb

source = [a,b,c,d]

ops = [+,-,*,/]

choose two from source x,y
choose operation
combine x,y with an op to make p
drop x,y from source and replace with p

originals = [3,5,7,9]  // all elements are different
source = originals
originals = [3,5,7,9]

randomly select x = 5 , y = 9
check if x divisible by y or y divisible by x  if so use / else choose op +,-,* at random_bytes
op = -
p = 9 - 5 = 4
source = [3,4,7]

randomly select (x,y) = (4,7)
op = *
p = 4*7 = 28
source = [3,28]

x = 3, y = 28
op = -

source = [25]
Target = 25 

/*

