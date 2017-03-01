<%@ Page Language="C#" MasterPageFile="~/SealifeProtection.master" Title="Login"%>

<asp:Content ID="Login" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
<script language="C#" runat="server">
void Login_Authenticate(object sender, AuthenticateEventArgs e)
{
  DS1.SelectCommand = "SELECT * FROM login WHERE userName = '" + Login.UserName +
    "' AND userPwd = '" + Login.Password + "'";

  DS1.Select(DataSourceSelectArguments.Empty);
}

private void CheckLogin(object sender, 
  SqlDataSourceStatusEventArgs e)
{
  if (e.AffectedRows > 0)
  {
    FormsAuthentication.RedirectFromLoginPage(Login.UserName,  false);
  }
  else
  {
    Login.FailureText="Invalid Login";
  }
}
</script>
    <div class="border">
    <title>Forms Authentication</title>
    <link href="Style1.css" rel="stylesheet" type="text/css" />
    <asp:AccessDataSource ID="DS1" runat="server" 
      DataFile="login.accdb" OnSelected="CheckLogin" />

    <div>
        
      <asp:Login ID="Login" runat="server" 
        OnAuthenticate="Login_Authenticate" CssClass="login"
        TitleText="<br />Please enter your details <br /> below to login for this site. <br /><br />" 
        UserNameLabelText="Username:" 
        UserNameRequiredErrorMessage="Username required<p />" 
        PasswordLabelText="Password:" 
        PasswordRequiredErrorMessage="Password required"
        Height = "250" Width = "330"
        LoginButtonText="Click to login" DisplayRememberMe="false">
        <LabelStyle CssClass="loginText" />
        <TitleTextStyle CssClass="loginText" />
        <ValidatorTextStyle CssClass="loginValidator" />
      </asp:Login>
      <p />

      <asp:ValidationSummary id="vlSummary1" Font-Names="Arial" 
        Visible="true" CssClass="vldSummary"
        runat="server" ValidationGroup="Login" 
        HeaderText="Please correct the following errors:" />

    </div>
   </div>
</asp:Content>