#!C:\Users\manju\AppData\Local\Programs\Python\Python36-32\python.exe
print ("Content-Type: text/html; charset=utf-8\n\n")

import matplotlib.pyplot as plt, mpld3                  ## Ploting
import numpy as np                                      ## Array operations
import pandas as pd                                     ## For dataframes
import pandas_datareader as web                         ## Package and modules for importing data
import datetime                                         ## For using dates
import sys                                              ## For passing user choice to .py file
from sklearn.linear_model import LinearRegression       ## Including Linear Regression for Prediction
from sklearn.model_selection import train_test_split    ## Train test splitting.
import matplotlib.dates as mdates

ch = sys.argv[1]                                        ## Passing 1 argument from php to this file.
ch = int(ch)                                            ## String to int converssion
# ch=3

start = datetime.datetime.now().date() + datetime.timedelta(-366)   ## Settting start and end dates.
end = datetime.date.today()
 
if ch==1:
    stock = web.DataReader("AAPL", "yahoo", start, end) # First argument is the series we want, second is the source ("yahoo" for Yahoo! Finance), third is the start date, fourth is the end date
    titleVar = 'Apple Inc.'
    stk = "AAPL"
elif ch==2:
    stock = web.DataReader("AMZN", "yahoo", start, end)
    titleVar = 'Amazon.com, Inc.'
    stk = "AMZN"
elif ch==3:
    stock = web.DataReader("GOOG", "yahoo", start, end)
    titleVar = 'Alphabet Inc'
    stk = "GOOG"
elif ch==4:
    stock = web.DataReader("MSFT", "yahoo", start, end)
    titleVar = 'Microsoft Corporation'
    stk = "MSFT"
elif ch==5:
    stock = web.DataReader("NVDA", "yahoo", start, end)
    titleVar = 'NVIDIA Corporation'
    stk = "NVDA"
else:
    print('Error! Error! Errrooorrrr!')
 
labels = []
stock.to_csv('stock.csv')



fig1 = plt.figure(1)
plt.plot(stock["Adj Close"])                            # Plot the adjusted closing price of stock
plt.grid()
fnt2 = plt.title("Last 1 year prices of "+titleVar)    # Title for plot 
fnt2.set_size(18)
plt.xlabel('Months')
plt.ylabel('Stock price '+titleVar)
mpld3.fig_to_html(fig1)
mpld3.save_html(fig1,"plot.html")



fig2 = plt.figure(2)
start = datetime.datetime.now().date() + datetime.timedelta(-31)
stock_val = pd.read_csv('stock.csv')
new_stock_val = stock_val[['Date','Close']]
new_stock_val = stock_val[pd.to_datetime(stock_val['Date']) > pd.to_datetime(start)] ## Select values only upto previous month. This was hard :(
new_stock_val.to_csv('stock2.csv')
x=new_stock_val['Date']
y=new_stock_val['Close']
plt.grid()
plt.plot_date(x, y,fmt="r-",marker='o', color='b')          ## show blue dots
fnt1 = plt.title("Last 1 month stock value of "+titleVar)
fnt1.set_size(18)
plt.gcf().autofmt_xdate()                                   ## Rotate text
fig2.set_size_inches(16,7.2)
fig2.savefig('img/plots/plot.png',dpi = 100,bbox_inches="tight") ## Saving output as png image.Remove padding.


fig3, ax = plt.subplots()
plt.grid()
start = datetime.datetime.now().date() + datetime.timedelta(-92)        ## 3 months
stock_val = pd.read_csv('stock.csv')
new_stock_val = stock_val[['Date','Adj Close']]
new_stock_val = stock_val[pd.to_datetime(stock_val['Date']) > pd.to_datetime(start)] ## Select values only upto previous month. This was hard :(
ax.plot(new_stock_val['Adj Close'])
ax.xaxis.set_major_formatter(mdates.DateFormatter("%Y-%m"))
ax.xaxis.set_minor_formatter(mdates.DateFormatter("%Y-%m"))
fnt3 = plt.title("Last 3 month stock value of "+titleVar)
plt.xlabel("Days")
plt.ylabel("Stock value")
fnt3.set_size(18)
mpld3.fig_to_html(fig3)
mpld3.save_html(fig3,"plot2.html")


# Prediction Starts [Under Progress..]

sv = pd.read_csv('stock2.csv')
X = sv['Date']
X = pd.Series(pd.factorize(X)[0] + 1, X.index)  # For converting date to sequence of no.
X = X.values.reshape(-1, 1)

Y = sv['Close']
Y = Y.values.reshape(-1, 1)

X_train, X_test, y_train, y_test = train_test_split(X, Y, test_size=0.1, random_state=0)
regressor = LinearRegression()
regressor.fit(X_train, y_train)
##y_pred = regressor.predict(y_test)
y_pred = regressor.predict(len(X))
# print(y_pred)


fig32 = plt.figure(5)
ax = fig32.add_subplot(111)
if(Y[(len(X)-1)]<y_pred):   ## Excel sheet contain len rows filled.1st in headding so ignore (len-1).
    ax.plot(y_pred,'^',label=y_pred,color='g', markersize=20)
    fnt = plt.text(0.015,y_pred-0.5, float(np.round(y_pred, 2)),fontsize=20)
    # fnt1 = plt.text(-0.0025,y_pred-1, float(np.round((y_pred-Y[21]), 4)),fontsize=12,color='g')
else:
    ax.plot(y_pred,'v',label=y_pred,color='r',markersize=20)
    fnt = plt.text(0.015,y_pred, float(np.round(y_pred, 2)),fontsize=20)
    # fnt1 = plt.text(-0.0025,y_pred-1, float(np.round((y_pred-Y[21]), 4)),fontsize=12,color='r')
plt.axis('off')
fig32.set_size_inches(3,3)
fig32.savefig('img/plots/'+stk+'.png',dpi = 100) ## ,bbox_inches="tight"

# Prediction ends

# News Section     Under Progress 

import urllib3
from bs4 import BeautifulSoup

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning) ## For removing warnings related to certificates.
url = 'https://www.marketwatch.com/investing/stock/'+stk
http = urllib3.PoolManager()
response = http.request('GET', url)
soup = BeautifulSoup(response.data.decode('utf-8'),"html.parser")
soup = soup.findAll("div", {"class":"article__content"})
for i in range(0,20):
    with open("news.html", "a") as file:
        file.write("\n"+str(soup[i]))


## https://www.google.co.in/search?q=aapl&rlz=1C1CHBF_enIN769IN769&source=lnms&tbm=fin&sa=X&ved=0ahUKEwie2d-597PaAhXHtI8KHeQuAKMQ_AUICigB&biw=1227&bih=577#scso=uid_O-XOWq-3N4aMvQTzgbHQDA_5:0
## https://www.google.com/search?tbm=fin&ei=HTzOWrnYMYTivAT11ZuoAQ&q=aapl&oq=aapl

# End of news section