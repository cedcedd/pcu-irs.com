--Create userViews table from users table and department table to display userID, name, contact_no, address, email, access and departmentName
CREATE VIEW userViews AS
SELECT users.userID, users.name, users.contact_no, users.address, users.email, users.access, users.password,users.userStatus, department.departmentID, department.departmentName
FROM users
INNER JOIN department ON users.departmentID = department.departmentID;

--Create productViews table from product table and category table to display productID, productName, productQuantity, unit, expirationDate, price and categoryName
CREATE VIEW productViews AS
SELECT product.productID, product.productName, product.productQuantity, product.unit, product.expirationDate, product.price, category.categoryID, category.categoryName, product.status
FROM product
INNER JOIN category ON product.categoryID = category.categoryID;

--Create purchaseOrderViews table from purchaseorder table, supplier, users,category and product to get the company name, name, category name, productName, orderDate, orderQuantity, orderUnitCost, orderStatus.
CREATE VIEW purchaseOrderViews AS
SELECT purchaseorder.orderID, supplier.companyID, supplier.companyName, users.name, product.productID, product.productName, purchaseorder.orderDate, purchaseorder.expect_date ,purchaseorder.orderQuantity, purchaseorder.orderUnitCost, purchaseorder.orderStatus, purchaseorder.status
FROM purchaseorder
INNER JOIN supplier ON purchaseorder.companyID = supplier.companyID
INNER JOIN users ON purchaseorder.userID = users.userID
INNER JOIN product ON purchaseorder.productID = product.productID

--Create productRequestViews table from productRequst, users, department, category, product table to get name, departmentName, categoryName, productName, requestDate, requestQuantity, requestStatus.
CREATE VIEW productRequestViews AS
SELECT productRequest.requestID, users.name, department.departmentID, department.departmentName, category.categoryName, product.productID,  product.productName, productRequest.requestDate, productRequest.requestQuantity, productRequest.requestStatus
FROM productRequest
INNER JOIN users ON productRequest.userID = users.userID
INNER JOIN department ON productRequest.departmentID = department.departmentID
INNER JOIN category ON productRequest.categoryID = category.categoryID
INNER JOIN product ON productRequest.productID = product.productID

--Create reservationVenueViews table 
CREATE VIEW reservationVenueViews AS
SELECT reservationVenue.reservationID, users.userID, users.name, department.departmentID, department.departmentName, reservationVenue.email, users.contact_no, users.address, venue.venueName, reservationVenue.nameOfActivity, reservationVenue.numberOfGuests, reservationVenue.reserveDate, reservationVenue.checkIn, reservationVenue.checkOut, reservationVenue.reservationStatus
FROM reservationVenue
INNER JOIN users ON reservationVenue.userID = users.userID
INNER JOIN venue ON reservationVenue.venueID = venue.venueID
INNER JOIN department ON reservationVenue.departmentID = department.departmentID

--Create reservationVehicleViews table from reservationVehicle, users, vehicle , department to get reservationVehicleID, userID, name, email, contact_no, address, departmentName, vehicleName, numberOfSeaters,resDate, pickupDate/Time, returnDate/Time, reservationStatus
CREATE VIEW reservationVehicleViews AS
SELECT reservationVehicle.reservationVehicleID, users.userID, users.name, reservationVehicle.email, users.contact_no, users.address, department.departmentID, department.departmentName, reservationVehicle.nameOfActivity, vehicle.vehicleName, vehicle.numberOfSeaters, reservationVehicle.numberOfPassenger, reservationVehicle.resDate, reservationVehicle.pickUp, reservationVehicle.returnDate, reservationVehicle.reservationStatus
FROM reservationVehicle
INNER JOIN users ON reservationVehicle.userID = users.userID
INNER JOIN vehicle ON reservationVehicle.vehicleID = vehicle.vehicleID
INNER JOIN department ON reservationVehicle.departmentID = department.departmentID  



















