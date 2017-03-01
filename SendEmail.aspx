<%@ Page Language="C#" MasterPageFile="~/SealifeProtection.master" Title="welcome" Theme="SkinFile" %>
<%@ Import Namespace="System.Net.Mail" %>
<%@ Import Namespace="System.Net" %>
<asp:Content ID="mainContent" ContentPlaceHolderID="ContentPlaceHolder1" runat="Server">

<script Language="c#" runat="server">

public void SendEmail(object sender, EventArgs e) 
{ 
   MailMessage newMsg = new MailMessage(); 
   
   foreach (GridViewRow gvRow in gvCustomers.Rows) 
   { 
      CheckBox cb = (CheckBox)gvRow.FindControl("chkEmail"); 

      if (cb != null && cb.Checked) 
      { 
         newMsg.To.Add(new MailAddress(gvRow.Cells[3].Text, 
          gvRow.Cells[1].Text + " " + gvRow.Cells[2].Text)); 
      } 
   } 
   
   newMsg.From = new MailAddress("yzha735@student.monash.edu","yan"); 
   newMsg.Subject = txtSubject.Text; 
   newMsg.Body = txtMsg.Text; 
  
   try 
   { 
     SmtpClient smtp = new SmtpClient();
     smtp.Host = "smtp.monash.edu.au"; 
     smtp.Send(newMsg); 
     lblMail.Text = "Mail Successfully Sent"; 
   } 
   catch (Exception exc) 
   { 
     lblMail.Text = exc.Message; 
   } 
}

protected void dsCustomers_Selecting(object sender, SqlDataSourceSelectingEventArgs e)
{

}
</script>

    <title>Send Email</title>
        <div class="border" >
         <article class="ScrollStyleY">
       <asp:AccessDataSource ID="dsAccess" runat="server"  DataFile="~/members.accdb" 
      SelectCommand="SELECT [MemberId],[FullName],[Email],[Mobile] FROM [members]" >
    </asp:AccessDataSource>
    <link rel="stylesheet" href="style.css" type="text/css" />
<%--      <style type="text/css">
          .customerGrid {}
      </style>--%>
    <asp:label id="lblMail" CssClass="error" runat="server" />
    <p />

    <asp:GridView ID="gvCustomers" runat="server"  DataSourceID="dsAccess"
      AutoGenerateColumns="False"  RowStyle-CssClass="customerRow" 
      AlternatingRowStyle-CssClass="customerAlternate" 
      HeaderStyle-CssClass="customerHeader" AllowSorting="true"
      CssClass="customerGrid" CellPadding="5" DataKeyNames="MemberId" Width="313px">

<AlternatingRowStyle CssClass="customerAlternate"></AlternatingRowStyle>
      <Columns>
            <asp:BoundField DataField="MemberID" Visible="false"
             HeaderText="MemberID" SortExpression="MemberID" ReadOnly="True" InsertVisible="False" />
            <asp:BoundField DataField="FullName" HeaderText="FullName" SortExpression="FullName" />
        
            <asp:BoundField DataField="Mobile" HeaderText="Mobile" SortExpression="Email" />

            <asp:BoundField DataField="Email" HeaderText="Email" SortExpression="Email" />

            <asp:TemplateField HeaderText="Select">
                <ItemTemplate>
                    <asp:CheckBox runat="server" id="chkEmail" />
                </ItemTemplate>
            </asp:TemplateField>

      </Columns>
    </asp:GridView>
    <br /><br />

    <table class="emailTable">
    <tr>
      <td class="emailHeader" width="15%">From</td>
      <td class="emailRow">Yan</td>
    </tr>
    <tr>
      <td class="emailHeader" width="15%">Subject</td>
      <td class="emailRow">
        <asp:TextBox ID="txtSubject" Width="350" runat="server" />
      </td>
    </tr>
    <tr><td></td><td>
        <asp:RequiredFieldValidator Id="vldSubject" ControlToValidate="txtSubject" 
            Display="Dynamic" ErrorMessage="Your subject is empty" runat="server" />
                 </td></tr>
    <tr>
      <td class="emailHeader">Message</td>
      <td class="emailRow">
        <asp:TextBox runat="server" ID="txtMsg" 
          TextMode="MultiLine" Columns="55" Rows="15" />
      </td>
    </tr>
    </table>
    <br />
    
    <asp:Button id="SendMail" runat="server"  OnClick="SendEmail" Text="Send Email"/>
 <br /><br />	
             </article>
            </div> 
    </asp:Content>