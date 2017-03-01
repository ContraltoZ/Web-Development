<%@ Page Language="C#" MasterPageFile="~/SealifeProtection.master" Title="welcome"  Theme="SkinFile" %>

<script runat="server">

    protected void TreeView1_SelectedNodeChanged(object sender, EventArgs e)
    {

    }
</script>

<asp:Content ID="mainContent" ContentPlaceHolderID="ContentPlaceHolder1" Runat="Server">
        <div class="mapBorder">
                <asp:SiteMapDataSource ID="SiteMapDataSource1"  runat="server" />
                <asp:TreeView ID="TreeView1" runat="server"  CssClass="map" DataSourceID="SiteMapDataSource1" 
                    ShowLines="True" OnSelectedNodeChanged="TreeView1_SelectedNodeChanged" />
        </div>
            </asp:Content>