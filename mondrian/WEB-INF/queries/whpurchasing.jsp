<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
    <%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
        <%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>

            <jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver"
                jdbcUrl="jdbc:mysql://localhost/schpurchasing?user=root&password="
                catalogUri="/WEB-INF/queries/schpurchasing.xml">

                select {[Measures].[OnOrderQty], [Measures].[ReceivedQty], [Measures].[RejectedQty],
                [Measures].[UnitPrice], [Measures].[TotalCost]} ON
                COLUMNS, {([Time],[Product],[Vendor],[Storage_Location],[Employee])} ON ROWS
                from [SchPurchasing]


            </jp:mondrianQuery>

            <c:set var="title01" scope="session">Query PURCHASING SCHEMA using Mondrian OLAP</c:set>