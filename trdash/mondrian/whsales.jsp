<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>

    <jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver"
        jdbcUrl="jdbc:mysql://localhost/schsales?user=root&password="
        catalogUri="/WEB-INF/queries/schsales.xml">

            select {[Measures].[Quantity], [Measures].[Unit Price], [Measures].[Sales Amount]} ON
            COLUMNS, {([Time],[Product],[Customer],[Territory],[Employee])} ON ROWS
            from [SchSales]

    </jp:mondrianQuery>

    <c:set var="title01" scope="session">Query SALES SCHEMA using Mondrian OLAP</c:set>