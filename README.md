# WA-2026-Walter-Wolf
WA tul 2026 :/
SELECT Customers.CustomerID,Customers.CustomerName,ProductName FROM Customers JOIN Orders ON Customers.CustomerID = Orders.CustomerID JOIN OrderDetails ON Orders.OrderID = OrderDetails.OrderID JOIN Products ON OrderDetails.ProductID = Products.ProductID Where Customers.Country = 'France';
