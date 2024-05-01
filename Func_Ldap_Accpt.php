<?php 
// //////////////////////////////////////////////////////////////////////////

function Ldap_Accpt($Ldap_Connection, $DomainName_Enroll, $DomainPass_Enroll, $Matrix_OutputArray) {
extract($Matrix_OutputArray);
$Filler = "";
$EA23_VAR_UserPosition_Enroll = "New";
$EA70_Enroll_LogFile = "New";
$EA58_Action_TimeStamp_Enroll = date("m/d/Y | h:i a", time());
$Enroll_Log_Data = array();
$Enroll_Log_Data[] = "$EA58_Action_TimeStamp_Enroll". "\n";
    // Determine if the if the Username is a Email 
if (strcspn($DomainName_Enroll, '@') != strlen($DomainName_Enroll)){
//updateStaffEA($url, '');
$DomainName_Enroll = substr($DomainName_Enroll, 0, strpos($DomainName_Enroll, "@"));
$DomainName_Enroll = trim($DomainName_Enroll);
    //echo "Changed: $DomainName_Enroll"; echo "<br>";
} else {
$DomainName_Enroll = trim($DomainName_Enroll);
     //echo "Ready: $DomainName_Enroll"; echo "<br>";
}
//LDAP Bind paramters, need to be a normal AD User account.
//$EA53_CCSD_Ldap_Base_Domain_PHP
//$EA05_CCSD_Domain_Login_Suffix_PHP
// We have to set this option for the version of Active Directory we are using.
ldap_set_option($Ldap_Connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
ldap_set_option($Ldap_Connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search
// binding to ldap server
if (($bind = ldap_bind($Ldap_Connection, $DomainName_Enroll . $EA05_CCSD_Domain_Login_Suffix_PHP, $DomainPass_Enroll)) && ($DomainName_Enroll != "") && ($DomainPass_Enroll != "")){

//Get standard users and contacts
$Ldap_User_SearchFilter = "(&(objectClass=user)(objectCategory=person)(sAMAccountName=" . $DomainName_Enroll . "))";

$Ldap_AttribsFilter = array(
'samaccountname',
'comment',
'displayname',
'mail',
'department',
'title',
'distinguishedname',
'employeetype',
'description',
'physicaldeliveryofficename',
'employeeid',
);

// //////////////////////////////////////////////////////////////////////////
// //////////////////////////////////////////////////////////////////////////
// //////////////////////////////////////////////////////////////////////////

?>