-- get componentdescriptions from certain object with its id
SELECT componentdescription.* 
FROM component
INNER JOIN componentdescription 
	ON componentdescription.componentdescriptionid = component.componentdescriptionid
WHERE component.componentid IN (SELECT objectcomponentassign.componentid FROM objectcomponentassign WHERE objectcomponentassign.objectid = 1);

-- get componentvalues from certain object with its id
SELECT componentvalue.*
FROM component
INNER JOIN componentvalue 
	ON componentvalue.componentvalueid = component.componentvalueid
WHERE component.componentid IN (SELECT objectcomponentassign.componentid FROM objectcomponentassign WHERE objectcomponentassign.objectid = 1);

