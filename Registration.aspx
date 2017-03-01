<%@ Page Title="" Language="C#" MasterPageFile="~/SealifeProtection.master" AutoEventWireup="true" Theme="SkinFile" %>
<script language="c#" runat="server">
    protected void validateSupportMethod(object source, System.Web.UI.WebControls.ServerValidateEventArgs args)
    {
        args.IsValid = false;
        String Address = txtAddress.Text;
        String post = txtPost.Text;
        String selectedState = stateList.SelectedValue;
        Boolean donate = checkbox1.Checked;
        Boolean volunteer = checkbox2.Checked;
        if (!donate && !volunteer)
        {
            validateSupport.ErrorMessage="Please choose at least one";
            return;
        }
        if (volunteer && (Address.Equals("") || post.Equals("") || selectedState.Equals("none")))
        {
            validateSupport.ErrorMessage =
                "Please provide full address so that we can match suitable program fro you";
            return;
        }
        if (volunteer && !Address.Equals("") && !post.Equals("") && selectedState.Equals("Others"))
        {
            validateSupport.ErrorMessage = "Sorry, we don't have any program in your area yet.";
            return;
        }
        args.IsValid = true;
    }
    private void submit_Click(object sender, EventArgs e)
    {
        if (!(Page.IsValid))
        {  return; }
        if (checkbox1.Checked && !checkbox2.Checked)
        { 
            feedback.Text = "You are planning to donate, thank you!";
        }
        if (checkbox2.Checked && !checkbox1.Checked)
        {
            feedback.Text = "You are planning to be a volunteer, thank you! We will check programs in "
              + stateList.SelectedValue + " near " + txtPost.Text + " and in touch soon.";
        }
        if (checkbox2.Checked && checkbox1.Checked)
        {
            feedback.Text = "You are planning to donate as well as be a volunteer, thank you! We will check programs in "
                + stateList.SelectedValue + " near " + txtPost.Text + " and in touch soon.";
        }
        message1.Text = txtFullName.Text;
        message2.Text = RdoGender.SelectedValue;
        message3.Text = txtEmail.Text;
        message4.Text = txtMobile.Text;
        message5.Text = txtAddress.Text;
        message6.Text = txtPost.Text + " " + stateList.SelectedValue;
        outputPanel.Visible=true;
        inputPanel.Visible = false;

        dsAccess.InsertParameters[0].DefaultValue = txtFullName.Text;
        dsAccess.InsertParameters[1].DefaultValue = RdoGender.SelectedValue;
        dsAccess.InsertParameters[2].DefaultValue = txtEmail.Text;
        dsAccess.InsertParameters[3].DefaultValue = txtMobile.Text;
        dsAccess.InsertParameters[4].DefaultValue = txtAddress.Text;
        dsAccess.InsertParameters[5].DefaultValue = txtPost.Text;
        dsAccess.InsertParameters[6].DefaultValue = stateList.SelectedValue;
        dsAccess.InsertParameters[7].DefaultValue = txtPassword.Text;
        dsAccess.Insert();
    }
    //protected void Page_Load(object sender, EventArgs e){
    //    Listbox2.Items.Clear();
    //    Listbox1.Items.Clear();
    //    Listbox1.Items.Add("Dolphin");
    //    Listbox1.Items.Add("Turtles");
    //    Listbox1.Items.Add("Coral");
    //}
    protected void transferRight(object sender, EventArgs e)
    {
        var item1 = Listbox1.SelectedItem;
        var item2 = Listbox2.SelectedItem;
        if (Listbox1.SelectedIndex != -1)
        {
                Listbox1.Items.Remove(item1);
                Listbox2.Items.Add(item1);
                item1 = null; item2 = null;
                Listbox1.SelectedIndex = -1;
                Listbox2.SelectedIndex = -1;
        }
    }

    protected void transferLeft(object sender, EventArgs e)
    {
        var item2 = Listbox2.SelectedItem;
        if (Listbox2.SelectedIndex != -1)
        {
            Listbox2.Items.Remove(item2);
            Listbox1.Items.Add(item2);
            Listbox1.SelectedIndex = -1;
        }
    }

    protected void dsAccess_Selecting(object sender, SqlDataSourceSelectingEventArgs e)
    {

    }
</script>

<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" runat="Server">

    <asp:AccessDataSource runat="server" ID="dsAccess" DataFile="~/Members.accdb" OnSelecting="dsAccess_Selecting" 
        DeleteCommand="DELETE FROM [Members] WHERE [MemberID] = ?" 
        InsertCommand="INSERT INTO [Members] ([FullName], [Gender], [Email], [Mobile], [Address], [Postcode], [State], [Password]) VALUES (?, ?, ?, ?, ?, ?, ?, ?)" >
        <InsertParameters>
            <asp:Parameter Name="FullName" Type="String" />
            <asp:Parameter Name="Gender" Type="String" />
            <asp:Parameter Name="Email" Type="String" />
            <asp:Parameter Name="Mobile" Type="String" />
            <asp:Parameter Name="Address" Type="String" />
            <asp:Parameter Name="Postcode" Type="String" />
            <asp:Parameter Name="State" Type="String" />
            <asp:Parameter Name="Password" Type="String" />
        </InsertParameters>
    </asp:AccessDataSource>


    <div class="border">
        <asp:Panel id="inputPanel" runat="server" Visible="true">
        <table class="inputTable">
            <tr>
                <td colspan="3">
                    <asp:Label runat="server" Text="Registration Form" Font-Bold="True" /></td>
            </tr>
            <tr>
                <td class="label">
                    <asp:Label runat="server" Text="* Full Name :" ToolTip="only characters" /></td>
                <td class="textbox">
                    <asp:TextBox ID="txtFullName" runat="server" /></td>
                <td class="errormessage">
                    <asp:RequiredFieldValidator runat="server" ErrorMessage="Please enter full name"
                        ControlToValidate="txtFullName" /><br />
                    <asp:RegularExpressionValidator ControlToValidate="txtFullName" ValidationExpression="^[a-zA-Z]*$"
                        Display="Dynamic" ErrorMessage="REAL full name please" runat="server" /></td>
            </tr>
            <tr>
                <td class="label">
                    <asp:Label runat="server" Text="* Gender :" ToolTip="knowing your gender helps us to assign jobs better" /></td>
                <td class="textbox">
                    <asp:RadioButtonList ID="RdoGender" runat="server" RepeatDirection="Horizontal" Width="176px">
                        <asp:ListItem>Male</asp:ListItem>
                        <asp:ListItem>Female</asp:ListItem>
                    </asp:RadioButtonList></td>
                <td class="errormessage">
                    <asp:RequiredFieldValidator runat="server" ErrorMessage="Please choose your gender"
                        ControlToValidate="RdoGender"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <asp:Label runat="server" Text="* E-Mail :" ToolTip="Email will be the first option for us to contect with you" /></td>
                <td class="textbox">
                    <asp:TextBox ID="txtEmail" runat="server" /></td>
                <td class="errormessage">
                    <asp:RequiredFieldValidator runat="server" ErrorMessage="Please enter Email"
                        ControlToValidate="txtEmail" /><br />
                    <asp:RegularExpressionValidator runat="server" ControlToValidate="txtEmail" ErrorMessage="Invalid E-mail"
                        ValidationExpression=".*@.*\..*" /></td>
            </tr>
            <tr>
                <td class="label">
                    <asp:Label ID="lblMobile" runat="server" Text="Mobile" ToolTip="Just for emergency"></asp:Label>
                </td>
                <td class="textbox">
                    <asp:TextBox ID="txtMobile" runat="server" MaxLength="10"></asp:TextBox>
                </td>
                <td class="errormessage">
                    <asp:RegularExpressionValidator runat="server" ErrorMessage="Invalid Mobile Number"
                        ValidationExpression="^([0]{1})([0-9]{9})$" ControlToValidate="txtMobile"></asp:RegularExpressionValidator>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <asp:Label runat="server" Text="Address :" /></td>
                <td class="textbox">
                    <asp:TextBox ID="txtAddress" runat="server" TextMode="MultiLine" /></td>
                <td class="errormessage"></td>
            </tr>

            <tr>
                <td class="label">
                    <asp:Label runat="server" Text="Postcode:"></asp:Label>
                </td>
                <td class="textbox">
                    <asp:TextBox ID="txtPost" runat="server" Width="95px" />
                    <asp:DropDownList ID="stateList" runat="server">
                        <asp:ListItem Selected="true" Value="none">--State--</asp:ListItem>
                        <asp:ListItem Text="NSW" Value="NSW" />
                        <asp:ListItem Text="QLD" Value="QLD" />
                        <asp:ListItem Text="WA" Value="WA" />
                        <asp:ListItem Text="TAS" Value="TAS" />
                        <asp:ListItem Text="VIC" Value="VIC" />
                        <asp:ListItem Text="Other" Value="Other" />
                    </asp:DropDownList>
                </td>
                <td class="errormessage">
                    <asp:RangeValidator ControlToValidate="txtPost" MinimumValue="1000" MaximumValue="9999" Type="Integer"
                        Display="Dynamic" ErrorMessage="Invalide Postcode" runat="server" /></td>
            </tr>
            <tr>
                <td class="label">
                    <asp:Label ID="lblPassword" runat="server" Text="* Password:" /></td>
                <td class="textbox">
                    <asp:TextBox ID="txtPassword" runat="server" TextMode="Password" /></td>
                <td class="errormessage">
                    <asp:RequiredFieldValidator runat="server" ErrorMessage="Please set password"
                        ControlToValidate="txtPassword" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    <asp:Label runat="server" Text="* Confirm Pw:"/></td>
                <td class="textbox">
                    <asp:TextBox ID="txtConfirmPwd" runat="server" TextMode="Password"/></td>
                <td class="errormessage">
                    <asp:RequiredFieldValidator runat="server" ErrorMessage="Please re-enter password"
                        ControlToValidate="txtConfirmPwd"/><br />
                    <asp:CompareValidator runat="server" ErrorMessage="Password didnt match"
                        ControlToCompare="txtPassword" ControlToValidate="txtConfirmPwd"/></td>
            </tr>
            <tr>
                <td class="label">
                    <asp:Label runat="server" Text="* Support us by:" ToolTip="Full address is required for volunteers"/></td>
                <td class="textbox">
                    <%--<asp:CheckBoxList id="supportMethod" runat="server">--%>
                    <asp:CheckBox ID="checkbox1" Text="Donate" runat="server" />
                    <asp:CheckBox ID="checkbox2" Text="Volunteer" runat="server" tooltip="Full address needed "/><%--</asp:CheckBoxList>--%></td>
                <td class="errormessage">
                    <asp:CustomValidator id="validateSupport" runat="server"
                        ControlToValidate="txtPassword" OnServerValidate="validateSupportMethod" errormessage="no"/>
                    <asp:Label ID="supportError" runat="server" /></td>
            </tr>
            <tr>
                <td />
                <td class="style12">
                    <asp:Button ID="btnSubmit" runat="server" Text="Submit" onclick="submit_Click"/>
                    <%--<asp:Button ID="btnClear" runat="server" CausesValidation="False" OnClick="btnClear_Click"
                    Text="Clear" />--%></td>
                <td/>
            </tr>
        </table>
            </asp:Panel>
        <asp:Panel id="outputPanel" runat="server" Visible="false">
        <table id="outputTable">
            <tr>
                <td><asp:Label ID="Label1" runat="server" Text="Full Name:" CssClass="label" /></td>
                <td><asp:Label ID="message1" runat="server" CssClass="message" /></td>
                <td><asp:Label ID="Label2" runat="server" Text="Gender:" CssClass="label" /></td>
                <td><asp:Label ID="message2" runat="server" CssClass="message" /></td>
            </tr>
            <tr>
                <td><asp:Label ID="Label3" runat="server" Text="Email:" CssClass="label" /></td>
                <td><asp:Label ID="message3" runat="server" CssClass="message" /></td>
                <td><asp:Label ID="Label4" runat="server" Text="Mobile:" CssClass="label" /></td>
                <td><asp:Label ID="message4" runat="server" CssClass="message" /></td>
            </tr>
            <tr>
                <td><asp:Label ID="Label5" runat="server" Text="Address:" CssClass="label" /></td>
                <td><asp:Label ID="message5" runat="server" CssClass="message" /></td>
                <td><asp:Label ID="Label6" runat="server" Text="Postcode:" CssClass="label" /></td>
                <td><asp:Label ID="message6" runat="server" CssClass="message" /></td>
            </tr>
            <tr>
                <td colspan="4"><asp:Label ID="feedback" runat="server"  CssClass="label" /></td></tr>
            <tr><td colspan="4"> optional Survery: <br />
                Among three pics in our home page, what are you interested in?</td></tr>
            <tr><td colspan="2">pics in our home page:<br /><asp:ListBox ID="Listbox1" runat="server" value="Listbox1_DoubleClick">
                    <asp:ListItem Text="Dolphin"/><asp:ListItem Text="Turtles"/><asp:ListItem Text="Coral"/>
                    </asp:ListBox></td>
                <td colspan="2">interested:<br /><asp:ListBox ID="Listbox2" runat="server">
                    </asp:ListBox></td>
            </tr>
            <tr><td></td><td><asp:Button OnClick="transferRight" Text="add interest"  runat="server"/></td>
               <td><asp:Button OnClick="transferLeft" Text="remove interest" runat="server" /></td><td></td></tr>
            <tr><td colspan="2">
                    <asp:HyperLink ID="showMembers" runat="server" NavigateUrl="~/Members.aspx" Text="View all members" /></td>
                <td colspan="2">
                    <asp:HyperLink ID="searchMembers" runat="server" NavigateUrl="~/MemberSearch.aspx" Text="Search a member" />
                </td></tr>
        </table></asp:Panel>
    </div>
</asp:Content>
